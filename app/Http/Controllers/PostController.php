<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title_content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            // 'video' => 'required|video|mimes:video/avi,video/mpeg,video/quicktime',
            'description' => 'required',
        ]);

        $path = $request->file('image')->store('public/images');
        $video_path = $request->file('video')->store('public/images');

        $post = new Post;

        $post->title = $request->title_content;
        $post->description = $request->description;
        $post->image = $path;
        $post->video = $video_path;

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    // public function show(Post $id)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    public function edit( Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title_content'=>'required',
            'description'=>'required',
        ]);

        $post = Post::find($id);

        if($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            // 'video' => 'required|video|mimes:video/avi,video/mpeg,video/quicktime',
            ]);
            $path = $request->file('image')->store('public/images');
            $video_path = $request->file('video')->store('public/images');
            $post->image = $path;
            $post->video = $video_path;

            $post->title = $request->title_content;
            $post->description = $request->description;
            $post->save();

            return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $post
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
        ->with('success', 'Post has been deleted successfully');
    }
}
