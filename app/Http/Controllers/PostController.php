<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Post;
use App\Models\Topic;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; //Facade for storage operations

class PostController extends Controller
{
    public function createPost()
    {
        $topics = Topic::all('title', 'id');
        return view('post.create', compact('topics'));
    }

    public function edit(Post $post)
    {
        $topics = Topic::all('title', 'id');
        return view('post.edit', compact('post', 'topics'));
    }

    public function update(StorePostRequest $request, Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }

        // Define topic
        if ($request->topic_mode === 'new') {

            $topic = Topic::create([
                'title' => $request->new_topic_title,
                'user_id' => Auth::id(),
            ]);
        } else {

            $topic = Topic::findOrFail($request->existing_topic_id);
        }

        $imagePath = $post->picture; //Default - keep last picture without changing

        //If $request has new picture
        //delete old one and save new
        if ($request->hasFile('userPicture')) {

            // delete old image
            if ($post->picture) {
                Storage::disk('public')->delete($post->picture);
            }

            // save new one
            $imagePath = $request->file('userPicture')->store('post-images', 'public');
        }

        $post->update([
            'content' => $request->content,
            'topic_id' => $topic->id,
            'picture' => $imagePath,
        ]);

        return redirect()->route('home.index')->with('success', 'Your post has been updated');
    }

    public function store(StorePostRequest $request)
    {
        // Define topic
        if ($request->topic_mode === 'new') {

            $topic = Topic::create([
                'title' => $request->new_topic_title,
                'user_id' => Auth::id(),
            ]);
        } else {
            $topic = Topic::findOrFail($request->existing_topic_id);
        }

        // Post processing
        $imagePath = null;

        if ($request->hasFile('userPicture')) {
            $imagePath = $request->file('userPicture')
                ->store('post-images', 'public');
        }

        // Creation post
        Post::create([
            'content' => $request->content,
            'user_id' => Auth::id(),
            'topic_id' => $topic->id,
            'picture' => $imagePath,
        ]);

        return redirect()->route('home.index')
            ->with('success', 'Post created successfully!');
    }


    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            abort(403);
        }
        
        $post->delete();

        return redirect()->route('home.index');
    }
}
