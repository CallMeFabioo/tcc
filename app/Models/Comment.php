<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'post_id', 'text',
    ];

    protected $hidden = [
    	'updated_at'
    ];

    /**
     * [addLike description]
     *
     * @param [type] $post [description]
     */
    public function addLike($post)
    {
        return $this->likes()->save($post);
    }

	 	/**
     * Get the post that owns the comment.
     */
    public function post()
    {
     	return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Get the user that posted the comment.
     */
    public function owner()
    {
     	return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the post's likes.
     */
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    /**
     * [getCreatedAtAttribute description]
     *
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

}
