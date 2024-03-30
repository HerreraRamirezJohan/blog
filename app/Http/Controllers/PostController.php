<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return view(
            'posts.index',
            [
                'categories' => Category::whereHas('posts', function ($query) {
                    $query->published();
                })->take(10)->get()
            ]
        );
    }
    public function show(Post $post) //The name of var will be need the same that the route in web.php
    {
        return view(
            'posts.show',
            [
                'post' => $post
            ]
        );
    }
}
