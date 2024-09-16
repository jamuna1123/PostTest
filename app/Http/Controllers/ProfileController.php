<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        // Handle the profile image
         if ($request->input('image')) {
            // Delete old images
            if ($request->user()->image) {
                $oldOriginalImagePath = 'images/original/'. $request->user()->image;
                $oldResizedImagePath = 'images/resized/'. $request->user()->image;

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

                 $request->user()->image = $originalPath;
            }
        }

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        Alert::success('Success', 'Profile update successfully.');

        return redirect()->route('profile.edit');
        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

 public function upload(Request $request)
    {
        if ($request->file('image')) {
            $path = $request->file('image')->store('tmp', 'public');

            return response()->json(['path' => $path]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function revert(Request $request)
    {
        $path = $request->getContent();
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }

        return response()->json(['success' => true]);
    }

    public function load($filename)
    {
        return response()->file(storage_path('app/public/images/'.$filename));

    }

    // Handle fetching image (e.g., after upload or on form load)
    public function fetch($filename)
    {
        return response()->json(['filename' => $filename, 'url' => Storage::url('images/'.$filename)]);
    }

}
