<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $Post = Post::all();
        $postvalue = count($Post);

        return view('backend.layouts.main', compact('postvalue'));
    }
}
