<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
        'content',
        'picture',
    ];

    protected static function booted()
    {
        // Увеличиваем счетчик при создании поста
        static::created(function ($post) {
            $post->topic()->increment('posts_count');
        });

        // Уменьшаем счетчик при удалении поста
        static::deleted(function ($post) {
            $topic = $post->topic;

            if ($topic) {
                $topic->decrement('posts_count');

                // Твоя логика: если постов 0 — удаляем тему
                if ($topic->posts_count <= 0) {
                    $topic->delete();
                }
            }
        });
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
