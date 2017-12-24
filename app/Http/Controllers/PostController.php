<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with(['branch', 'createdBy', 'postImages'])->latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'post_images.*' => 'mimes:jpeg,bmp,png',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'branch_id' => auth()->user()->branch_id,
            'created_by' => auth()->user()->id,
        ]);

        if ($request->hasFile('post_images')) {
            $fileImages = $request->file('post_images');
            foreach ($fileImages as $key => $fileImage) {

                $imageSize = getimagesize($fileImage);

                // Persist the PostImage model.
                $post->postImages()->create([
                    'url' => $fileImage->store('post-images', 'public'),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                ]);
            }
        }

        return redirect()->route('posts.index');
    }
}
