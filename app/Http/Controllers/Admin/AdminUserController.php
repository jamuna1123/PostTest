<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestUserPassword;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AdminUserController extends Controller
{
    // public function index()
    // {

    //     $users = User::paginate(5);

    //     return view('admin.user.index', compact('users'));
    // }

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('admin.user.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $user = new User; // Create an empty User instance

        return view('admin.user.create', compact('user'));
    }

    public function store(StoreUser $request)
    {
        // Create a new user instance
        $user = new User;
        $user->name = $request->name; // Ensure phone is numeric and 10 digits

        // Handle each field individually
        $user->email = strtolower($request->email); // Ensure email is lowercase
        $user->phone = $request->phone; // Ensure phone is numeric and 10 digits
        $user->address = $request->address; // Address is nullable
        $user->status = $request->has('status') ? 1 : 0;

        // Hash the password if present
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Set created_at and updated_at with Nepal timezone
        $currentTime = Carbon::now();
        $user->created_at = $currentTime;
        $user->updated_at = null;

        // Handle image upload and resizing
        if ($request->input('image')) {
            $imagePath = $request->input('image');
            $filename = basename($imagePath);

            // Define paths
            $originalPath = 'images/original/'.$filename;
            $resizedPath = 'images/resized/'.$filename;

            // Move the file from 'tmp' to 'images'
            Storage::disk('public')->move($imagePath, $originalPath);

            // Resize the image using Intervention Image
            $resizedImage = Image::make(storage_path('app/public/'.$originalPath))->resize(300, 200);

            // Store the resized image
            Storage::disk('public')->put($resizedPath, (string) $resizedImage->encode());

            $user->image = $originalPath;
        }

        // Set email_verified_at to null if the email is changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the new user
        $user->save();

        session()->flash('success', 'User created successfully.');

        return redirect()->route('users.show', $user->id);
    }

    public function edit($id)
    {

        $user = User::findOrFail($id);

        return view('admin.user.edit', compact('user'));
    }

    public function update(StoreUser $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name; // Ensure phone is numeric and 10 digits

        // Handle each field individually
        $user->email = strtolower($request->email); // Ensure email is lowercase
        $user->phone = $request->phone; // Ensure phone is numeric and 10 digits
        $user->address = $request->address; // Address is nullable
        // Set status to 1 by default if auth id is 1, otherwise take from request
        if (auth()->check() && auth()->id() === $user->id) {
            $user->status = 1;
        } else {
            $user->status = $request->has('status') ? 1 : 0;
        }

        // Handle the profile image
        if ($request->input('image')) {
            // Delete old images
            if ($user->image) {
                $oldOriginalImagePath = 'images/original/'.$user->image;
                $oldResizedImagePath = 'images/resized/'.$user->image;

                if (Storage::exists($oldOriginalImagePath)) {
                    Storage::delete($oldOriginalImagePath);
                }
                if (Storage::exists($oldResizedImagePath)) {
                    Storage::delete($oldResizedImagePath);
                }
            }

            $imagePath = $request->input('image');
            $filename = basename($imagePath);

            // Define paths
            $originalPath = 'images/original/'.$filename;
            $resizedPath = 'images/resized/'.$filename;

            // Move the file from 'tmp' to 'images'
            Storage::disk('public')->move($imagePath, $originalPath);

            // Resize the image using Intervention Image
            $resizedImage = Image::make(storage_path('app/public/'.$originalPath))->resize(300, 200);

            // Store the resized image
            Storage::disk('public')->put($resizedPath, (string) $resizedImage->encode());

            $user->image = $originalPath;
        }

        // Set email_verified_at to null if the email is changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        session()->flash('success', 'User updated successfully.');

        return redirect()->route('users.show', $user->id);
    }

    public function show($id)
    {

        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id);

        if ($user->image) {
            Storage::disk('public')->delete('images/original/'.$user->image);
            Storage::disk('public')->delete('images/resized/'.$user->image);
        }
        $user->delete();
        session()->flash('success', 'User deleted successfully.');

        return redirect()->route('users.index');

    }

    // public function updateStatususer(Request $request, $id)
    // {

    //     $user = User::findOrFail($id); // Fetch the user by ID
    //     $user->status = $request->status; // Update the status
    //     $user->save(); // Save the user

    //     return response()->json(['success' => true]); // Return a success response
    // }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => true]);
    }

    public function password(string $id)
    {
        $user = user::find($id);

        return view('admin.user.change-password', compact('user'));
    }

    public function updatePassword(RequestUserPassword $request, string $id)
    {

        $user = user::findorfail($id);
        if ($request->current_password && $request->new_password) {
            if (Hash::check($request->current_password, $user->password)) {
                if (Hash::check($request->new_password, $user->password)) {

                    return redirect()->route('password', $user->id)->with('error', 'The new password is same as old password');

                }

                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->route('users.show', $user->id)->with('success', 'password updated successfully');
            } else {

                return redirect()->route('password', $user->id)->with('error', 'current password not match');
            }

        } elseif ($request->confirm_password && $request->new_password) {
            if ($request->new_password == $request->confirm_password) {
                $user->password = Hash::make($request->new_password);

                $user->save();

                return redirect()->route('users.show', $user->id)->with('success', 'password updated successfully');
            } else {

                return redirect()->route('password', $user->id)->with('error', 'password not match');
            }

        }

    }

    public function bulkUpdateStatus(Request $request)
    {
        $ids = $request->input('ids');
        $authId = auth()->id();  // Get the authenticated user's ID

        // Toggle status for users except the authenticated user
        User::whereIn('id', $ids)
            ->where('id', '!=', $authId)  // Exclude the authenticated user
            ->update(['status' => DB::raw('NOT status')]);

        // Ensure the authenticated user's status is always 1
        User::where('id', $authId)->update(['status' => 1]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        // Delete post categories
        User::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => 'User deleted successfully!']);
    }
}
