<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost()
    {
        $topics = Topic::all('title', 'id');
        return view('post.create', compact('topics'));
    }

    public function store(Request $request)
    {
        Post::create($request->all());

        return redirect(route('home.index'));
    }
}
