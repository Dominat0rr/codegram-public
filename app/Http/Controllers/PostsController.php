<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        //$posts = Post::whereIn('user_id', $users)->orderBy('created_at', 'DESC')->get();
        //$posts = Post::whereIn('user_id', $users)->latest()->get();
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5); // with pagination

        return view('posts.index', compact('posts'));
    }

    public function create() {
        return view('posts.create');
    }

    public function store() {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
            //'image' => 'required|image',
        ]);

        // Resize and upload file
        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        // Get Authenticated user & save user post
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        //dd(request('image');
        //dd(request()->all());
        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Post $post) {
//        return view('posts.show', [
//            'post' => $post,
//        ]);

        //dd($post);
        return view('posts.show', compact('post'));
    }
}
