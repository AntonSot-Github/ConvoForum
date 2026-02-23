<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Post;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'topic'])->latest()->paginate();
        return view('home', compact('posts'));
    }
}
