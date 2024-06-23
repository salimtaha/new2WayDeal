<?php

namespace App\Http\Controllers\API\Auth\Reset;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ChangePasswordRequest;
use App\Http\Requests\API\CustomerForgotPasswordRequest;
use App\Http\Requests\API\OTPVerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CustomerResetPasswordController extends Controller
{
    public function forgot(CustomerForgotPasswordRequest $request)
    {
        $user = User::where('phone',$request->phone)->first();

        $user->update([
            'otp'=>rand(1000,9999)
        ]);

        SendSMS($user->phone, "[2WayDeal] Your OTP is: $user->otp .Don't share this OTP with anyone. Use it to reset your password");

        SendTelegram("[2WayDeal] Your OTP is: $user->otp .Don't share this OTP with anyone. Use it to reset your password");

        SendTelegram("☝️☝️ This is for $user->name($user->email) to reset his password. ☝️☝️(CUSTOMER)");

        auth()->login($user);

        $token = auth()->user()->createToken('Customer')->plainTextToken;

        return SendResponse(200, 'OTP sent successfully', ['token'=>$token]);
    }

    public function otp(OTPVerifyRequest $request)
    {

        $user = auth('sanctum')->user();

        if($user->otp != $request->otp)
        {
            return SendResponse(422, 'Invalid OTP');
        }

        $user->update([
            'otp'=>null
        ]);

        return SendResponse(200, 'OTP verified successfully');
    }

    public function change(ChangePasswordRequest $request)
    {

        $user = auth('sanctum')->user();

        $user->update([
            'password'=>bcrypt($request->password)
        ]);

        return SendResponse(200, 'Password changed successfully');
    }
}
