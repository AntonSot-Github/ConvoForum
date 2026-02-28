<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Topic;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function createPost()
    {
        $topics = Topic::all('title', 'id');
        return view('post.create', compact('topics'));
    }

    public function store(StorePostRequest $request)
    {
        // Определяем тему
        if ($request->topic_mode === 'new') {

            $topic = Topic::create([
                'title' => $request->new_topic_title,
                'user_id' => Auth::id(),
            ]);
        } else {

            $topic = Topic::findOrFail($request->existing_topic_id);
        }

        // Обработка изображения
        $imagePath = null;

        if ($request->hasFile('userPicture')) {
            $imagePath = $request->file('userPicture')
                ->store('post-images', 'public');
        }

        // Создание поста
        Post::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'picture' => $imagePath,
        ]);

        return redirect()
            ->route('home.index')
            ->with('success', 'Post created successfully!');
    }
}
