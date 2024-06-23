<?php

namespace App\Http\Controllers\API\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class CustomerLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request['password'], $user->password)) {

            if ($user->status == 'blocked') {
                return SendResponse(403, 'Your account has been blocked.');
            }

            $token =  $user->createToken('User Token',['role:customer'])->plainTextToken;

            return SendResponse(200, 'User logged in successfully',['token'=>$token]);
        }

        return SendResponse(401,'Invalid Email/Password.');
    }
}
