<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password', 'remember_token',
    ];

    /**
     * [posts description]
     *
     * @return [type] [description]
     */
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    /**
     * [comments description]
     *
     * @return [type] [description]
     */
    public function comments()
    {
    	return $this->hasMany(Comment::class);
    }

    /**
     * [favorites description]
     *
     * @return [type] [description]
     */
    public function favorites()
    {
    	return $this->belongsToMany(Post::class, 'favorites', 'user_id', 'post_id');
    }

    /**
     * [following description]
     *
     * @return [type] [description]
     */
    public function following()
    {
    	return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * [followers description]
     *
     * @return [type] [description]
     */
    public function followers()
    {
    	return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * [getAvatarAttribute description]
     *
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getAvatarAttribute($value)
    {
        return json_decode($value);
    }


}
