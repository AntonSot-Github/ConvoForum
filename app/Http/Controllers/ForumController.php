<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with(['user', 'topic'])->latest();

        if ($request->search) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->paginate(3)->withQueryString();
        $topicsCount = Topic::count();
        return view('home', compact('posts', 'topicsCount'));
    }
}
