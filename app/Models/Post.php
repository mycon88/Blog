<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // In a "belongsTo" relationship, each instance of the 'Post' model belongs to a single instance of the 'User' model
    public function user()
    {
        // 'belongsTo' is an Eloquent Method used to define a "belong to" relationship
        // The argument passed in the belongsTo passed, tells laravel which model the 'Post' belongs to.
        return $this->belongsTo('App\Models\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\PostLike');
    }
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
