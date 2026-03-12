<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\Topic;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::with('user')->latest()->paginate(25);
        $posts = Post::with(['user', 'topic'])->get();
        return view('topics.index', compact('topics', 'posts'));
    }
}
