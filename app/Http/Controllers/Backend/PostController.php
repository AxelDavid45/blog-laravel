<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
     * Show the form for editing the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post                $post
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        //Update the fields
        $post->update(
            [
                'title' => $request->input('title'),
                'body'  => $request->input('body'),
                'iframe' => $request->input('iframe')
            ]
        );

        //Update if the image exists
        if ($request->file('image')) {
            //Delete the old image
            $imageData = ['disk' => 'public', 'file' => $post->image];
            $this->deleteImage($imageData);
            //Update the field
            $post->image = $request->file('image')->store('posts', 'public');
            //Save the model
            $post->save();
        }

        return back()->with('status', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        //Delete the image
        $imageData = [
            'disk' => 'public',
            'file' => $post->image
        ];

        $this->deleteImage($imageData);
        //Delete the record
        $post->delete();

        return back()->with('status', 'Post deleted');
    }


    /**
     * Delete an image from an specific disk
     * @param array $data['disk','file']
     */
    private function deleteImage(array $data) {
        Storage::disk($data['disk'])->delete($data['file']);
    }
}
