<?php

namespace App\Http\Controllers;

use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $Post = Post::all();
        $postvalue = count($Post);
        $postActiveValue = Post::where('status', 1)->count();
        $postInActiveValue = Post::where('status', 0)->count();

        return view('backend.layouts.main', compact('postvalue', 'postActiveValue', 'postInActiveValue'));
    }
}
