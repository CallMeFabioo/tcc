<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use App\Http\Requests;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    public function like($uid)
    {
      $post = $this->getPost($uid);

    	$like = Like::firstOrNew([
    		'user_id' => auth()->user()->id,
    		'likeable_id' => $post->id
    	]);

    	$post->addLike($like);

    	return $this->getPost($uid);
    }

    public function unlike($uid)
    {
    	$post = $this->getPost($uid);

    	Like::where('likeable_id', $post->id)
    			->where('user_id', auth()->user()->id)
    			->delete();

    	return $this->getPost($uid);
    }

    public function getPost($uid) {
    	return Post::withCount(['likes', 'comments'])->with([
		  		'owner', 'comments.owner', 'comments.likes',
		  		'comments' => function($query) {
		  			$query->withCount('likes')->with(['likes' => function($query) {
				  		$query->where('likes.user_id', auth()->user()->id);
				  	}])->orderBy('created_at', 'desc');
		  		},
		  		'likes' => function($query) {
		    		$query->where('likes.user_id', auth()->user()->id);
		    	}])
		  		->where('uid', $uid)
		  		->firstOrFail();
    }

    public function comment(Request $request, $uid)
    {
    	$commentId = $request->get('comment_id');

    	if(is_null($commentId))
    	{
    		return $this->createComment($request);
    	}

      $item = $this->getComment($commentId);

    	$like = Like::firstOrNew([
    		'user_id' => auth()->user()->id,
    		'likeable_id' => $item->id
    	]);

    	$item->addLike($like);

    	return $this->getComment($commentId);
    }

    public function uncomment(Request $request, $uid)
    {
    	$commentId = $request->get('comment_id');

    	$item = $this->getComment($commentId);

    	Like::where('likeable_id', $item->id)
    			->where('user_id', auth()->user()->id)
    			->delete();

    	return $this->getComment($commentId);
    }

    public function getComment($commentId) {
    	return Comment::withCount('likes')->with(['owner', 'likes' => function($query) {
  						$query->where('likes.user_id', auth()->user()->id);
  					}])->where('id', $commentId)
  					->firstOrFail();
    }

    public function createComment(Request $request)
    {
    	$comment = Comment::create([
    		'user_id' => (int) auth()->user()->id,
    		'post_id' => (int) $request->get('post_id'),
    		'text' => $request->get('comment')
    	]);

    	$comment->likes_count = 0;
    	$comment->load('owner', 'likes');

    	return response()->json($comment);
    }
}
