<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'images', 'description', 'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id', 'updated_at'
    ];

    /**
     * Add like to a post
     *
     * @param [Eloquent] $post
     */
    public function addLike(Like $like)
    {
        return $this->likes()->save($like);
    }

    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the owner of the post.
     */
    public function owner()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Mutator for created_at field
     *
     * @param  [string] $value
     * @return [Carbon\Carbon]
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    /**
     * Mutator for decode JSON data of images field
     *
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getImagesAttribute($value)
    {
        return json_decode($value);
    }
}
