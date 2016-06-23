<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
		public function index($take = 5)
		{
			$loggedUser = auth()->user()->id;
		  return User::where('id', '<>', $loggedUser)
			  					->where(function($query) {
							  		$query->join('followers', 'users.id', '<>', 'followers.user_id');
							  		$query->join('followers', 'users.id', '<>', 'followers.follower_id');
							  	})->take($take)->orderByRaw('RAND()')->get();
		}

    public function show($username)
    {
      return User::where('username', $username)->firstOrFail();
    }

    public function followers(Request $request)
    {
    	$userId = $request->get('user_id');

    	if(!is_null($userId) && $request->isMethod('post')) {
    		$loggedUser = auth()->user()->id;

    		$follow = User::where('id', $userId)->firstOrFail();

    		return User::where('id', $loggedUser)->firstOrFail()->following()->save($follow);
    	}
      return auth()->user()->followers;
    }

    public function following()
    {
      return auth()->user()->following;
    }

    public function favorites()
    {
      return auth()->user()->favorites()->with('owner')->get();
    }

    public function me(Request $request)
    {
      try {
	      if (! $user = JWTAuth::parseToken()->authenticate())
        {
          return response()->json([
          	'message' => 'User not found',
  					'status_code' => 404
          ], 404);
        }
	    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
	        return response()->json(['token_absent'], $e->getStatusCode());
	    }

	    // the token is valid and we have found the user via the sub claim
	    return response()->json($user);
    }
}
