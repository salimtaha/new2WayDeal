<?php

namespace App\Http\Controllers\API\Auth\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\OTPVerifyRequest;
use App\Http\Requests\API\SellerAddressRequest;
use App\Http\Requests\API\SellerRegisterRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class SellerRegisterController extends Controller
{

    public function store(SellerRegisterRequest $request)
    {
        $seller = Store::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'otp' => rand(1000, 9999)
        ]);

        $seller->account()->create(
            [
                'value' => 0,
                'status' => 'enable'
            ]
        );
        
        $token = $seller->createToken('Seller Token',['role:seller'])->plainTextToken;

        SendSMS($seller->phone, "[2WayDeal] Your OTP is: $seller->otp .Don't share this OTP with anyone.");

        SendTelegram("[2WayDeal] Your OTP is: $seller->otp .Don't share this OTP with anyone.");

        SendTelegram("☝️☝️ This is for $seller->name($seller->email) to verify his account. ☝️☝️");

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

            return SendResponse(200, 'Seller verified successfully');
        }

        return SendResponse(401, 'Invalid OTP');
    }

    public function address(SellerAddressRequest $request)
    {
        auth()->user()->update(
            [
                'governorate_id'=>$request->governorate_id,
                'city_id'=>$request->city_id,
                'street'=>$request->street,
                'image' => uploadImage($request->image, 'stores'),
            ]
        );
        return SendResponse(200, 'Address added successfully');
    }

    public function certificates(Request $request)
    {
        $request->validate(
            [
            'health_approval_certificate' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'commercial_resturant_license' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]
        );

        auth()->user()->update(
            [
                'health_approval_certificate' => uploadImage($request->health_approval_certificate, 'stores/certificates/health_approval_certificate', auth()->user()->health_approval_certificate),
                'commercial_resturant_license' => uploadImage($request->commercial_resturant_license, 'stores/certificates/commercial_resturant_license', auth()->user()->commercial_resturant_license),
            ]
        );

        return SendResponse(200, 'Certificates added successfully. We are working to verify your account.');
    }
}
