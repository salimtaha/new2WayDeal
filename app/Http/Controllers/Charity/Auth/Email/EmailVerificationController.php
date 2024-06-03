<?php

namespace App\Http\Controllers\Charity\Auth\Email;

use App\Models\Admin;
use App\Notifications\Charity\NewCharity;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Charity;
use App\Notifications\EmailVerificationCode;
use Illuminate\Auth\Events\Validated;

class EmailVerificationController extends Controller
{
    public $otp;
    public function __construct()
    {

        $this->otp = new Otp;
        $this->middleware(['guest:charity']);
    }
    public function emailVerfication(Request $request)
    {

        $request->validate([
            'email'=>'required|exists:charities,email',
            'otp'=>'required|max:6',
        ]);

        $otp2 = $this->otp->validate($request->email , $request->otp);

        if(!$otp2->status){
            return redirect()->back()->withErrors(['error' => 'رمز التحقق غير متطابق(فتح ي أحول) ']);
        }

        // change email verefied status
        $charity = Charity::where('email' , $request->email)->first();
        $charity->update(['email_verified_at'=>now()]);

        // make notification to admin that threre are new charity
        $admin =  Admin::first();
        $admin->notify(new NewCharity($charity));

        return redirect()->route('charities.showLogin');

    }

    public function tryAgain($email)
    {
        $charity = Charity::where('email' , $email)->first();
        $charity->notify(new EmailVerificationCode());

        return redirect()->route('charities.register.verify.form' , ['email'=>$charity['email']]);
    }
}
