<?php

namespace App\Http\Controllers\API\Auth\Reset;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\OTPVerifyRequest;
use App\Http\Requests\API\SellerForgotPasswordRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class SellerResetPasswordController extends Controller
{

    public function forgot(SellerForgotPasswordRequest $request)
    {
        $seller = Store::where('phone',$request->phone)->first();

        $seller->update([
            'otp'=>rand(1000,9999)
        ]);

        SendSMS($seller->phone, "[2WayDeal] Your OTP is: $seller->otp .Don't share this OTP with anyone. Use it to reset your password");

        SendTelegram("[2WayDeal] Your OTP is: $seller->otp .Don't share this OTP with anyone. Use it to reset your password");

        SendTelegram("☝️☝️ This is for $seller->name($seller->email) to reset his password. ☝️☝️(SELLER)");

        auth()->login($seller);

        $token = auth()->user()->createToken('seller')->plainTextToken;

        return SendResponse(200, 'OTP sent successfully', ['token'=>$token]);
    }

    public function otp(OTPVerifyRequest $request)
    {

        $seller = auth('sanctum')->user();

        if($seller->otp != $request->otp)
        {
            return SendResponse(422, 'Invalid OTP');
        }

        $seller->update([
            'otp'=>null
        ]);

        return SendResponse(200, 'OTP verified successfully');
    }

    public function change(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $seller = Seller::where('email', $request->user()->email)->first();

        $seller->password = bcrypt($request->password);
        $seller->save();

        return response()->json([
            'message' => 'Password changed successfully'
        ]);
    }
}
