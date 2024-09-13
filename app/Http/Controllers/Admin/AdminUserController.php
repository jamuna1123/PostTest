<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;
class AdminUserController extends Controller
{
    public function index()
    {

        $users = User::paginate(5);

        return view('admin.user.index', compact('users'));
    }

      public function show($id)
    {

        $user = User::findOrFail($id);

        return view('admin.user.show', compact('user'));
    }

    public function destroy($id)
    {

        $users = User::findOrFail($id);

        $users->delete();
        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('users.index');

    }

  // Export PDF
    public function exportPDF()
    {
        $users = User::all(); // Get all users

        // Load a view to generate PDF
        $pdf = PDF::loadView('admin.user.pdf', compact('users'));

        // Download the PDF with a specific filename
        return $pdf->download('users_list.pdf');
    }
 
}
