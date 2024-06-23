<?php

namespace App\Http\Controllers\API\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageUpload;
use App\Http\Requests\API\AddressRequest;
use App\Http\Requests\API\CustomerRegisterRequest;
use App\Http\Requests\API\OTPVerifyRequest;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerRegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRegisterRequest $request)
    {
        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'phone' => $request->phone,
                'otp' => rand(1000, 9999)
            ]
        );

        $token = $user->createToken('User Token',['role:customer'])->plainTextToken;

        SendSMS($user->phone, "[2WayDeal] Your OTP is: $user->otp .Don't share this OTP with anyone.");

        SendTelegram("[2WayDeal] Your OTP is: $user->otp .Don't share this OTP with anyone.");

        SendTelegram("☝️☝️ This is for $user->name($user->email) to verify his account. ☝️☝️");

        return SendResponse(201, "Your account is Created successfully. It's time to confirm your account",['token'=>$token]);

    }

    public function verify(OTPVerifyRequest $request)
    {

        if(auth()->user()->otp == $request->otp)
        {
            auth()->user()->update([
                'otp'=>null,
                'email_verified_at'=>now()
            ]);

            return SendResponse(200, 'User verified successfully');
        }

        return SendResponse(401, 'Invalid OTP');
    }

    public function address(AddressRequest $request)
    {
        $user = auth('sanctum')->user();
        $user->update(
            [
                'governorate_id' => $request->governorate_id,
                'city_id' => $request->city_id,
            ]
        );

        if ($request->hasFile('image')) {
            $user->update(
                [
                'image' => UploadImage($request->file('image'), 'avatars')
                ]
            );
        }

        return SendResponse(200, 'Address added successfully');
    }
}
