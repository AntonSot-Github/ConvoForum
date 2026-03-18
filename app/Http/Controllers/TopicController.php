<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $query = Topic::with('user')->latest();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $topics = $query->paginate(25)->withQueryString();
        $postsCount = Post::count();
        return view('topics.list', compact('topics', 'postsCount'));
    }

    public function show(Topic $topic)
    {
        $posts = Post::with(['user'])->where('topic_id', '=', $topic->id)->get();
        return view('topics.topic-show-posts', compact('topic', 'posts'));
    }

    public function destroy(Topic $topic)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->isAdmin()) {
            abort(403);
        }

        $topic->post()->delete();
        $topic->delete();

        return back()->with('success', "$topic->title is deleted");
    }
}
