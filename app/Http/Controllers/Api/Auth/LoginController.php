<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Failed form validation',
                'data' => $validator->errors(),
            ], 400);
        }


        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'Error',
                'message' => 'invalid email or password'
            ], 400);
        }

        try {
            $user = User::with('company')->where('email', $request->email)->firstOrFail();
            $token = $user->createToken('auth_token')->plainTextToken;
    
            return response()->json([
                'status' => 'Success',
                'access_token' => $token,
                'user' => $user,
            ]);

        } catch(Exception $err) {
            return response(401)->json([
                'status' => 'ERROR',
                'message' => $err->getMessage(),
            ]);
        }
    }
}
