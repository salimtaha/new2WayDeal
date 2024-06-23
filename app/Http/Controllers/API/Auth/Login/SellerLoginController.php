<?php

namespace App\Http\Controllers\API\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\LoginRequest;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SellerLoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request)
    {

        $store = Store::where('email', $request->email)->first();

        if ($store && Hash::check($request['password'], $store->password)) {
            if($store->status == 'pending'){
                return SendResponse(401,'Your account is under review . You will be notified once it is approved');
            }elseif($store->status == 'blocked'){
                return SendResponse(401,'Your account has been blocked . Contact support for more information');
            }

            $token =  $store->createToken('Seller Token',['role:seller'])->plainTextToken;

            return SendResponse(200, 'Seller logged in successfully',['token'=>$token]);
        }

        return SendResponse(401,'Invalid Username/Password');
    }
}
