<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AlbumImageDataTable;

use App\Models\Album;
use App\Models\AlbumImage;

class AlbumImageController extends Controller
{
      public function albumImage(AlbumImageDataTable $dataTable,$id)
    {
        $album = Album::findOrFail($id);

        return $dataTable->render('backend.albumimage.index',compact('album'));
    }

    public function destroy(string $id)
    {
        $albumImage  = AlbumImage::findOrFail($id);

        $albumImage ->delete();

        return redirect()->route('album-image.albumImage')->with('success', 'Album Image deleted successfully.');
    }
}

