<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $post = Post::orderBy('id', 'desc')->paginate(5);

        return view('backend.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post;

        // $parentCategoriesList = PostCategory::getNewsCategoryLists(null);
        $categories = PostCategory::where('status', '=', '1')->get();

        $users = User::all();

        return view('backend.post.create', compact('post', 'users', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {

        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;

        $post->slug = $request->slug;
        $post->post_category_id = $request->post_category_id;
        // Set created_at and updated_at with Nepal timezone
        $currentTime = Carbon::now();
        $post->created_at = $currentTime;
        $post->updated_at = null;

        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : Carbon::now();

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

            $post->image = $originalPath;
        }

        $post->status = $request->has('status') ? 1 : 0;

        $post->save();
        Alert::success('Success', 'Post created successfully.');

        return redirect()->route('post.show', $post->id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id);

        // Fetch only active categories
        $categories = PostCategory::whereNull('deleted_at')->where('status', '=', '1')->get();

        // Check if the post's category is soft-deleted
        $deletedCategory = PostCategory::withTrashed()->find($post->post_category_id);

        // If the category is soft-deleted, add it to the categories list
        if ($deletedCategory && $deletedCategory->trashed()) {
            $categories->push($deletedCategory);
        }

        $post->published_at = $post->published_at ? Carbon::parse($post->published_at) : null;

        return view('backend.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePost $request, $id)
    {

        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_category_id = $request->post_category_id; // Add parent_id

        $post->published_at = $request->published_at
           ? Carbon::parse($request->published_at)
           : $post->published_at;

        $post->slug = $request->slug;

        if ($request->input('image')) {
            // Delete old images
            if ($post->image) {
                $oldOriginalImagePath = 'images/original/'.$post->image;
                $oldResizedImagePath = 'images/resized/'.$post->image;

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

                $post->image = $originalPath;
            }
        }
        $post->status = $request->has('status') ? 1 : 0;
        $post->save();
        Alert::success('Success', 'Post updated successfully.');

        return redirect()->route('post.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $post = Post::findOrFail($id);

        if ($post->image) {
            Storage::disk('public')->delete('images/original/'.$post->image);
            Storage::disk('public')->delete('images/resized/'.$post->image);
        }

        $post->delete();
        Alert::success('Success', 'Post deleted successfully.');

        return redirect()->route('post.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $post = Post::findOrFail($id);

        //  $category = PostCategory::withTrashed()->findOrFail($id);
        return view('backend.post.show', compact('post'));
    }

    public function updateStatus(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->status = $request->status;
        $post->save();

        return response()->json(['success' => true]);

    }

    // public function upload(Request $request)
    // {
    //     if ($request->file('image')) {
    //         $path = $request->file('image')->store('tmp', 'public');

    //         return response()->json(['path' => $path]);
    //     }

    //     return response()->json(['error' => 'No file uploaded'], 400);
    // }

    // public function revert(Request $request)
    // {
    //     $path = $request->getContent();
    //     if (Storage::disk('public')->exists($path)) {
    //         Storage::disk('public')->delete($path);
    //     }

    //     return response()->json(['success' => true]);
    // }

    // public function load($filename)
    // {
    //     return response()->file(storage_path('app/public/images/'.$filename));

    // }

    // // Handle fetching image (e.g., after upload or on form load)
    // public function fetch($filename)
    // {
    //     return response()->json(['filename' => $filename, 'url' => Storage::url('images/'.$filename)]);
    // }
}
