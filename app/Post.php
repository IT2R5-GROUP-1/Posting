<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // These are the fields that can be mass-assigned
    protected $fillable = [
        'username',
        'title',
        'content',
    ];

    // If you ever want to define relationships, you can do it like this:
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
}
