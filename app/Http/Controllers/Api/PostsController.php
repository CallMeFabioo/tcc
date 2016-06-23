<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    public function index(Request $request)
    {
    	$take = $request->get('take') ?: 6;

    	$medias = Post::withCount(['likes', 'comments'])->with(['owner', 'likes' => function($query) {
    		$query->where('likes.user_id', auth()->user()->id);
    	}])->take($take)->get();

      return response()->json($medias);
    }

    public function show($uid)
    {
    	$media = Post::withCount(['likes', 'comments'])->with([
    		'owner', 'comments.owner',
    		'likes' => function($query) {
	    		$query->where('likes.user_id', auth()->user()->id);
	    	},
	    	'comments' => function($query) {
    			$query->withCount('likes')->with(['likes' => function($query) {
	    			$query->where('likes.user_id', auth()->user()->id);
	    		}])->orderBy('created_at', 'desc');
    	}])->where('uid', $uid)->firstOrFail();

      return response()->json($media);
    }

}
