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
        $postsCount = Post::count();
        return view('topics.list', compact('topics', 'postsCount'));
    }

    public function show(Topic $topic)
    {
        $posts = Post::with(['user'])->where('topic_id', '=', $topic->id)->get();
        return view('topics.topic-show-posts', compact('topic', 'posts'));
    }
}
