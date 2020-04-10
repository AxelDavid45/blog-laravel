<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PageController extends Controller
{
    public function posts()
    {
        return view('posts', [
           'posts' => Post::with('user')->latest()->paginate(5)
        ]);
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->get()->first();
        return view('post', [
            'post' => $post
        ]);
    }
}
