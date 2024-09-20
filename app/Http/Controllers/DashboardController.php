<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $Post = Post::all();
        $Postcategory = PostCategory::all();
        $uservalue = count($user);
        $postvalue = count($Post);
        $postActiveValue = Post::where('status', 1)->count();
        $postInActiveValue = Post::where('status', 0)->count();
        $postcategoryvalue = count($Postcategory);
        $postCategoryActiveValue = PostCategory::where('status', 1)->count();

        return view('backend.layouts.main', compact('uservalue', 'postvalue', 'postActiveValue', 'postInActiveValue', 'postCategoryActiveValue', 'postcategoryvalue'));
    }
}
