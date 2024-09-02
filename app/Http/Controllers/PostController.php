<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Support\Facades\Storage;
use Carbon;
class PostController extends Controller
{
    public function index(Request $request)
    {
        // Fetch post categories with pagination
        $post = Post::paginate(5); // Adjust the number per page as needed
        
        // Return the view with the paginated data
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
     $post = new Post();
 
    // Fetch all categories for the parent category select dropdown
    $parentCategoriesList= PostCategory::getNewsCategoryLists(null);
     
    // Get the list of parent categories
    $users = User::all();

    return view('admin.post.create', compact('post','users','parentCategoriesList'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        
        // Create a new Post
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        $post->slug = $request->slug;
        $post->post_category_id = $request->post_category_id; // Add parent_id
        $post->user_id = $request->user_id;
        $post->published_at= $request->published_at;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Store image in the 'public/images' directory
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
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
        // Find the Post by ID
        $post = Post::findOrFail($id);
        // Fetch all categories for the parent category select dropdown
         $users = User::all();
        $parentCategoriesList= PostCategory::getNewsCategoryLists(null);

//   if (is_string($post->published_at)) {
        $post->published_at = \Carbon\Carbon::parse($post->published_at);
    
        return view('admin.post.edit', compact('post','users','parentCategoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost $request, $id)
    {
        // Find the Post by ID
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_category_id = $request->post_category_id; // Add parent_id
        $post->user_id = $request->user_id;
        $post->published_at= $request->published_at;
        $post->slug = $request->slug;
    

        // Handle image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image && Storage::exists('public/' . $post->image)) {
                Storage::delete('public/' . $post->image);
            }
            // Store new image
            $imagePath = $request->file('image')->store('images', 'public');
            $post->image = $imagePath;
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
        // Find the Post by ID
        $post = Post::findOrFail($id);

        // Delete the image file if it exists
        if ($post->image && Storage::exists('public/' . $post->image)) {
            Storage::delete('public/' . $post->image);
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
        // Find the Post by ID
        $post = Post::findOrFail($id);

        // Return the view with the Post data
        return view('admin.post.show', compact('post'));
    }
}
