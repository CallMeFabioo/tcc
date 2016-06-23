<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
    	$credentials = $request->only('email', 'password');

    	try {
    		if(! $api_token = JWTAuth::attempt($credentials)) {
		      return response()->json([
						'message' => 'Invalid Credentials',
						'status_code' => 401
					], 401);
    		}

    	} catch (JWTException $e) {

    		return response()->json([
	  			'message' => 'Could not create token',
	  			'status_code' => 500
	  		], 500);
    	}

      return response()->json(compact('api_token'));
    }

    /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $this->validate($request, [ 'api_token' => 'required' ]);

        JWTAuth::invalidate($request->input('api_token'));
    }

    public function register(UserRequest $request)
    {
      $user = User::create([
        'name' => $request->get('name'),
        'username' => $request->get('username'),
        'email' => $request->get('email'),
        'password' => bcrypt($request->get('password'))
      ]);

      $api_token = JWTAuth::fromUser($user);

      return response()->json(compact('api_token'));
    }
}
