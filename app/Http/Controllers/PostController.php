<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class PostController extends Controller
{
    public function index(Request $request)
    {
       
        $post = Post::paginate(5);
        
        return view('admin.post.index', compact('post'));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
     $post = new Post();
 
  
    $parentCategoriesList= PostCategory::getNewsCategoryLists(null);
     

    $users = User::all();

    return view('admin.post.create', compact('post','users','parentCategoriesList'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePost $request)
    {
        
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;

        $post->slug = $request->slug;
        $post->post_category_id = $request->post_category_id; 
        $post->user_id = $request->user_id;
        $post->published_at = $request->published_at ? Carbon::parse($request->published_at) : Carbon::now();

       
        if ($request->hasFile('image')) {
           
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
       
        $post = Post::findOrFail($id);
       
         $users = User::all();
        $parentCategoriesList= PostCategory::getNewsCategoryLists(null);
         
        $post->published_at = $post->published_at ? Carbon::parse($post->published_at) : null;
        return view('admin.post.edit', compact('post','users','parentCategoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePost $request, $id)
    {
        
        $post = Post::findOrFail($id);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->post_category_id = $request->post_category_id; // Add parent_id
        $post->user_id = $request->user_id;

         $post->published_at = $request->published_at
            ? Carbon::parse($request->published_at)
            : $post->published_at;

        $post->slug = $request->slug;
    

        
        if ($request->hasFile('image')) {
            
            if ($post->image && Storage::exists('public/' . $post->image)) {
                Storage::delete('public/' . $post->image);
            }
       
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
      
        $post = Post::findOrFail($id);

       
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
        
        $post = Post::findOrFail($id);

      
        return view('admin.post.show', compact('post'));
    }
}
