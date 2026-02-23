<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        Post::create($request->all());

        return redirect(route('home.index'));
    }
}
