<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index(Request $request)
    {

        $post = Post::paginate(5);

        return view('backend.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $post = new Post;

        $parentCategoriesList = PostCategory::getNewsCategoryLists(null);

        $users = User::all();

        return view('backend.post.create', compact('post', 'users', 'parentCategoriesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {

        $post = new Post;
        $post->title = trim($request->title);
        $post->description = $request->description;

        $post->slug = $request->slug;
        $post->post_category_id = $request->post_category_id;
        $post->user_id = $request->user_id;
        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : Carbon::now();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Store original image
            $originalImagePath = 'images/original/'.$imageName;
            Storage::disk('public')->put($originalImagePath, file_get_contents($image));

            // Resize image
            $resizedImage = Image::make($image)->resize(300, 200);

            // Store resized image
            $resizedImagePath = 'images/resized/'.$imageName;
            Storage::disk('public')->put($resizedImagePath, (string) $resizedImage->encode());

            $post->image = $imageName;
        }

        $post->status = $request->has('status') ? 1 : 0;

        $post->save();

        return redirect()->route('post.index')
            ->with('success', 'Post created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {

        $post = Post::findOrFail($id);

        $users = User::all();
        $parentCategoriesList = PostCategory::getNewsCategoryLists(null);

        $post->published_at = $post->published_at ? Carbon::parse($post->published_at) : null;

        return view('backend.post.edit', compact('post', 'users', 'parentCategoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost $request, $id)
    {

        $post = Post::findOrFail($id);

        $post->title = trim($request->title);
        $post->description = $request->description;
        $post->post_category_id = $request->post_category_id; // Add parent_id
        $post->user_id = $request->user_id;

        $post->published_at = $request->published_at
           ? Carbon::parse($request->published_at)
           : $post->published_at;

        $post->slug = $request->slug;

        if ($request->hasFile('image')) {
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

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();

            // Store new original image
            $originalImagePath = 'images/original/'.$imageName;
            Storage::disk('public')->put($originalImagePath, file_get_contents($image));

            // Resize new image
            $resizedImage = Image::make($image)->resize(300, 200);
            $resizedImagePath = 'images/resized/'.$imageName;
            Storage::disk('public')->put($resizedImagePath, (string) $resizedImage->encode());

            $post->image = $imageName;
        }
        $post->status = $request->has('status') ? 1 : 0;
        $post->save();

        return redirect()->route('post.index')
            ->with('success', 'Post updated successfully.');
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

        return redirect()->route('post.index')
            ->with('success', 'Post deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $post = Post::findOrFail($id);

        return view('backend.post.show', compact('post'));
    }
}
