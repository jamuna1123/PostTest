<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use App\Http\Requests\StorePostCategory;
use App\Http\Requests\UpdatePostCategory;
use Illuminate\Support\Facades\Storage;
class PostCategoryController extends Controller
{
     public function index(Request $request)
    {
      
        $postCategories = PostCategory::paginate(5); // Adjust the number per page as needed
        
        
        return view('admin.post-category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
{
    
    $categories = PostCategory::all();
    
 
    $parentCategoriesList = PostCategory::getNewsCategoryLists();

    return view('admin.post-category.create', compact('categories', 'parentCategoriesList'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategory $request)
    {
        
        
        $postcategory = new PostCategory();
        $postcategory->title = $request->title;
        $postcategory->description = $request->description;

        $postcategory->slug = $request->slug;
        $postcategory->parent_id = $request->parent_id; // Add parent_id

      
       if ($request->input('image')) {
            $imagePath = $request->input('image');
            $filename = basename($imagePath);

            $newPath = 'images/' . $filename;


            // Move the file from 'tmp' to 'images'
            Storage::disk('public')->move($imagePath, $newPath);

            // Save the new image path in the database
            $postcategory->image = $newPath;
        }


        $postcategory->status = $request->has('status') ? 1 : 0;

        $postcategory->save();

        return redirect()->route('post-category.index')
                         ->with('success', 'Post Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      
        $postcategory = PostCategory::findOrFail($id);
        
        $categories = PostCategory::all();
        $parentCategoriesList= PostCategory::getNewsCategoryLists(null);


        return view('admin.post-category.edit', compact('postcategory', 'categories','parentCategoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategory $request, $id)
    {
       
        $postcategory = PostCategory::findOrFail($id);

        $postcategory->title = $request->title;
        $postcategory->description = $request->description;

        $postcategory->slug = $request->slug;
        $postcategory->parent_id = $request->parent_id; // Update parent_id

      
        if ($request->hasFile('image')) {
           
            if ($postcategory->image && Storage::exists('public/' . $postcategory->image)) {
                Storage::delete('public/' . $postcategory->image);
            }
           
            $imagePath = $request->file('image')->store('images', 'public');
            $postcategory->image = $imagePath;
        }

            $postcategory->status = $request->has('status') ? 1 : 0;
        $postcategory->save();

        return redirect()->route('post-category.index')
                         ->with('success', 'Post Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        $postcategory = PostCategory::findOrFail($id);

       
        if ($postcategory->image && Storage::exists('public/' . $postcategory->image)) {
            Storage::delete('public/' . $postcategory->image);
        }

        $postcategory->delete();

        return redirect()->route('post-category.index')
                         ->with('success', 'Post Category deleted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       
        $postcategory = PostCategory::findOrFail($id);

       
        return view('admin.post-category.show', compact('postcategory'));
    }

     public function upload(Request $request)
    {
        if ($request->file('image'))
        {
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
}
