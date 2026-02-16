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

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsTo(Topic::class);
    }
}
