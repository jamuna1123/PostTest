<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    public function index()
    {

        $users = User::paginate(5);

        return view('admin.user.index', compact('users'));
    }

    public function destroy($id)
    {

        $users = User::findOrFail($id);

        $users->delete();
        Alert::success('Success', 'User deleted successfully.');

        return redirect()->route('users.index');

    }
}
