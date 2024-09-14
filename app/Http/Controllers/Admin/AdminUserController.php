<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class AdminUserController extends Controller
{
    public function index()
    {

        $users = User::paginate(5);

        return view('admin.user.index', compact('users'));
    }

  

    /**
     * Store a newly created resource in storage.
     */
  
       

    public function show($id)
    {

        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {

        $users = User::findOrFail($id);

        if ($user->image) {
            Storage::disk('public')->delete('images/original/'.$user->image);
            Storage::disk('public')->delete('images/resized/'.$user->image);
        }
        $user->delete();
        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('users.index');

    }

   
}
