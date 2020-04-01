<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'posts.index',
            [
                'posts' => Post::latest()->paginate()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        //Store
        $post = Post::create(
            [
                'user_id' => auth()->user()->id
            ] + $request->all()
        );
        //Save the image
        if ($request->file('image')) {
            $post->image = $request->file('image')->store('posts', 'public');
            $post->save();
        }
        //redirect
        return back()->with('status', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post                $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
