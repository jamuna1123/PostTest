<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCategory;
use App\Http\Requests\UpdatePostCategory;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {

        $postCategories = PostCategory::paginate(5); // Adjust the number per page as needed

        return view('backend.post-category.index', compact('postCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = PostCategory::all();

        $parentCategoriesList = PostCategory::getNewsCategoryLists();

        return view('backend.post-category.create', compact('categories', 'parentCategoriesList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostCategory $request)
    {

        $postcategory = new PostCategory;
        $postcategory->title = trim($request->title);
        $postcategory->description = $request->description;

        $postcategory->slug = $request->slug;

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

            $postcategory->image = $imageName;
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
        $parentCategoriesList = PostCategory::getNewsCategoryLists(null);

        return view('backend.post-category.edit', compact('postcategory', 'categories', 'parentCategoriesList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostCategory $request, $id)
    {

        $postcategory = PostCategory::findOrFail($id);

        $postcategory->title = trim($request->title);
        $postcategory->description = $request->description;

        $postcategory->slug = $request->slug;

        if ($request->hasFile('image')) {
            // Delete old images
            if ($postcategory->image) {
                $oldOriginalImagePath = 'images/original/'.$postcategory->image;
                $oldResizedImagePath = 'images/resized/'.$postcategory->image;

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

            $postcategory->image = $imageName;
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

        if ($postcategory->image) {
            Storage::disk('public')->delete('images/original/'.$postcategory->image);
            Storage::disk('public')->delete('images/resized/'.$postcategory->image);
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

        return view('backend.post-category.show', compact('postcategory'));
    }
}
