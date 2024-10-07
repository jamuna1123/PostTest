<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PostCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCategory;
use App\Models\PostCategory;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostCategoryController extends Controller
{
    // public function index(Request $request)
    // {

    //     $postCategories = PostCategory::all(); // Adjust the number per page as needed

    //     return view('backend.post-category.index', compact('postCategories'));
    // }

    public function index(PostCategoryDataTable $dataTable)
    {
        return $dataTable->render('backend.post-category.index');
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
        $postcategory->title = $request->title;
        $postcategory->description = $request->description;
        // Set created_at and updated_at with Nepal timezone
        $currentTime = Carbon::now();
        $postcategory->created_at = $currentTime;
        $postcategory->updated_at = null;

        $postcategory->slug = $request->slug;

        if ($request->input('image')) {
            $imagePath = $request->input('image');
            $filename = basename($imagePath);

            // Define paths
            $originalPath = 'images/'.$filename;
            $thumbnail100Path = 'images/resized/100px_'.$filename;
            $thumbnail800Path = 'images/resized/800px_'.$filename;

            // Move the file from 'tmp' to 'images'
            Storage::disk('public')->move($imagePath, $originalPath);

            // Resize the image using Intervention Image

            // 100px width image
            $resized100Image = Image::make(storage_path('app/public/'.$originalPath))->resize(100, null, function ($constraint) {
                $constraint->aspectRatio(); // Keep aspect ratio
                $constraint->upsize(); // Prevent upsizing
            });
            Storage::disk('public')->put($thumbnail100Path, (string) $resized100Image->encode());

            // 800px width image
            $resized800Image = Image::make(storage_path('app/public/'.$originalPath))->resize(800, null, function ($constraint) {
                $constraint->aspectRatio(); // Keep aspect ratio
                $constraint->upsize(); // Prevent upsizing
            });
            Storage::disk('public')->put($thumbnail800Path, (string) $resized800Image->encode());

            // Save the new image path in the database (original path)
            $postcategory->image = $originalPath;
        }

        $postcategory->status = $request->has('status') ? 1 : 0;

        $postcategory->save();

        session()->flash('success', 'Post Category created successfully.');

        return redirect()->route('post-category.show', $postcategory->id);

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
    public function update(StorePostCategory $request, $id)
    {
        $postcategory = PostCategory::findOrFail($id);

        $postcategory->title = $request->title;

        $postcategory->description = $request->description;

        // Check if slug is empty and auto-generate from title
        if (empty($request->slug)) {
            $postcategory->slug = Str::slug($postcategory->title);
        } else {
            $postcategory->slug = $request->slug;
        }

        $postcategory->status = $request->has('status') ? 1 : 0;

        // // Handle the image update
        // if ($request->input('image')) {
        //     // Delete old images if an image already exists
        //     if ($postcategory->image) {
        //         $oldOriginalImagePath = 'images/original/'.$postcategory->image;
        //         $oldResizedImagePath = 'images/resized/'.$postcategory->image;

        //         if (Storage::exists($oldOriginalImagePath)) {
        //             Storage::delete($oldOriginalImagePath);
        //         }
        //         if (Storage::exists($oldResizedImagePath)) {
        //             Storage::delete($oldResizedImagePath);
        //         }
        //     }

        //     $imagePath = $request->input('image');
        //     $filename = basename($imagePath);

        //     // Define paths
        //     $originalPath = 'images/original/'.$filename;
        //     $resizedPath = 'images/resized/'.$filename;

        //     // Move the file from 'tmp' to 'images'
        //     Storage::disk('public')->move($imagePath, $originalPath);

        //     // Resize the image using Intervention Image
        //     $resizedImage = Image::make(storage_path('app/public/'.$originalPath))->resize(300, 200);

        //     // Store the resized image
        //     Storage::disk('public')->put($resizedPath, (string) $resizedImage->encode());

        //     $postcategory->image = $originalPath;

        // }

        $existimage = '800px_'.basename($postcategory->image);
        $currentimage = basename($request->image);
        // Delete old images if they exist

        if ($existimage != $currentimage) {

            // Delete old images if they exist
            if ($postcategory->image) {
                if (Storage::exists(public_path('storage/'.$postcategory->image))) {
                    Storage::delete(public_path('storage/'.$postcategory->image));
                }
                if (Storage::exists(public_path('storage/images/resized/800px_'.basename($postcategory->image)))) {
                    Storage::delete(public_path('storage/images/resized/800px_'.basename($postcategory->image)));
                }
                if (Storage::exists(public_path('storage/images/resized/100px_'.basename($postcategory->image)))) {
                    Storage::delete(public_path('storage/images/resized/100px_'.basename($postcategory->image)));
                }
            }
            $imagePath = $request->input('image');
            $filename = basename($imagePath);

            // Define paths
            $originalPath = 'images/'.$filename;
            $thumbnail100Path = 'images/resized/100px_'.$filename;
            $thumbnail800Path = 'images/resized/800px_'.$filename;

            // Move the file from 'tmp' to 'images'
            Storage::disk('public')->move($imagePath, $originalPath);

            // Resize the image using Intervention Image

            // 100px width image
            $resized100Image = Image::make(storage_path('app/public/'.$originalPath))->resize(100, null, function ($constraint) {
                $constraint->aspectRatio(); // Keep aspect ratio
                $constraint->upsize(); // Prevent upsizing
            });
            Storage::disk('public')->put($thumbnail100Path, (string) $resized100Image->encode());

            // 800px width image
            $resized800Image = Image::make(storage_path('app/public/'.$originalPath))->resize(800, null, function ($constraint) {
                $constraint->aspectRatio(); // Keep aspect ratio
                $constraint->upsize(); // Prevent upsizing
            });
            Storage::disk('public')->put($thumbnail800Path, (string) $resized800Image->encode());

            // Save the new image path in the database (original path)
            $postcategory->image = $originalPath;
        } else {

            $postcategory->image = $postcategory->image;
        }

        $postcategory->save();
        session()->flash('success', 'Post Category updated successfully.');

        return redirect()->route('post-category.show', $postcategory->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $postcategory = PostCategory::findOrFail($id);

        if ($postcategory->image) {
            Storage::disk('public')->delete('images/resized/100px_'.$postcategory->image);
            Storage::disk('public')->delete('images/resized/800px_'.$postcategory->image);
        }
        $postcategory->delete();
        session()->flash('success', 'Post Category deleted successfully.');

        return redirect()->route('post-category.index');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $postcategory = PostCategory::findOrFail($id);

        return view('backend.post-category.show', compact('postcategory'));
    }

    public function updateStatus(Request $request, $id)
    {
        $postCategory = PostCategory::findOrFail($id);
        $postCategory->status = $request->status;
        $postCategory->save();

        return response()->json(['success' => true]);

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

    public function bulkUpdateStatus(Request $request)
    {
        $ids = $request->input('ids');
        // Toggle status for post categories
        PostCategory::whereIn('id', $ids)->update(['status' => DB::raw('NOT status')]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');
        // Delete post categories
        PostCategory::whereIn('id', $ids)->delete();

        return response()->json(['success' => true, 'message' => 'Post Categories deleted successfully!']);
    }
    // }

}
