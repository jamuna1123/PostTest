<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    public function index()
    {

        $users = User::orderBy('id', 'asc')->paginate(5);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {

        $user = User::all();

        return view('admin.user.create', compact('user'));
    }

    public function store(StoreUser $request)
    {
        // Create a new user instance
        $user = new User;
        $user->fill($request->validated());
        // Hash the password
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        // Set created_at and updated_at with Nepal timezone
        $currentTime = Carbon::now();
        $user->created_at = $currentTime;
        $user->updated_at = null;

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

        // Set email_verified_at to null if email is changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Save the new user
        $user->save();

        Alert::success('Success', 'User created successfully.');

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
        $user->fill($request->validated());
      
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
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        Alert::success('Success', 'User update successfully.');

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
        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('users.index');

    }
}
