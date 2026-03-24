<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'topic_id',
        'content',
        'picture',
    ];

    protected static function booted()
    {
        // Increment the counter when creating a post. 
        static::created(function ($post) {
            $post->topic()->increment('posts_count');
        });

        // Decrease counter when post was deleted
        static::deleted(function ($post) {
            $topic = $post->topic;

            if ($topic) {
                $topic->decrement('posts_count');

                // If deleted post in topic was last, delete it
                if ($topic->posts_count <= 0) {
                    $topic->delete();
                }
            }
        });
    }

    //Accessor for views - $user->name || Deleted user
    public function getAuthorNameAttribute()
    {
        return $this->user ? $this->user->name : 'Deleted user';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
