<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostImage;
use Grafika\Grafika;
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

                // Persist the PostImage model.
                $postImage = $post->postImages()->create([
                    'url' => $fileImage->store('post-images', 'public')
                ]);

                // if the image is > 100kb or its height is > 400, resize it
                if ($fileImage->getClientSize() > 100000 || getimagesize($fileImage)[1] > 400) {
                    $editor = Grafika::createEditor();
                    $editor->open($fileImage, public_path() .'\\'. str_replace('/', '\\', $postImage->url));
                    $editor->resizeExactHeight($fileImage, 400);
                    $editor->save($fileImage, public_path() .'\\'. str_replace('/', '\\', $postImage->url));
                }
            }
        }

        return redirect()->route('posts.index');
    }
}
