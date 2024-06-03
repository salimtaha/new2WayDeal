<?php

namespace App\Http\Controllers\Charity\Auth\Password;

use Ichtrojan\Otp\Otp;
use App\Models\Charity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Admin\ResetPasswordNotification;

class ForgetPasswordController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function showEmailForm()
    {
        return view('charity.auth.passwords.email');
    }
    public function getVerficationCode(Request $request)
    {

        $request->validate([
            'email'=>['required' , 'email' , 'exists:charities,email'],
        ]);

        $email = $request->email;
        $charity =  Charity::where('email' , $email)->first();

        $charity->notify(new ResetPasswordNotification());

        return redirect()->route('charities.password.otp.form' , ['email'=>$charity->email]);


    }
    public function otpForm(Request $request)
    {
        return view('charity.auth.passwords.confirm' ,compact('request'));
    }


    public function checkOtp(Request $request)
    {
        $request->validate([
            'email'=>'required|exists:charities,email',
            'otp'=>'required|max:6',
        ]);

        $otp2 = $this->otp->validate($request->email , $request->otp);

        if(! $otp2->status){
            return redirect()->back()->withErrors(['error'=>' فشلت عمليه التحقق ,من فضلك ادخل الرمز الصحيح عشان مش ناقصه']);
        }

        return redirect()->route('charities.password.resetform' ,['email'=>$request->email]);

    }

}
