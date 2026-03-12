<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'topic'])->latest()->paginate(3);
        $topics = Topic::with(['user'])->latest()->paginate();
        return view('home', compact('posts', 'topics'));
    }
}
