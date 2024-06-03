<?php

namespace App\Http\Controllers\Admin\Auth\Password\PasswordOutside;

use App\Models\Admin;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\Admin\ResetPasswordNotification;

class ForgetPasswordOutsideController extends Controller
{
    private $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function showEmailForm()
    {
        return view('admin.auth.passwords.passwordOutside.email');
    }
    public function getVerficationCode(Request $request)
    {
        $request->validate([
            'email'=>['required' , 'email' , 'exists:admins,email'],
        ]);

        $email = $request->email;
        $admin =  Admin::where('email' , $email)->first();

        $admin->notify(new ResetPasswordNotification());

        return redirect()->route('admin.password.otp.form.outside' , ['email'=>$admin->email]);


    }
    public function otpForm($email)
    {
        return view('admin.auth.passwords.passwordOutside.confirm' , ['email'=>$email]);
    }


    public function checkOtp(Request $request)
    {
        $otp2 = $this->otp->validate($request->email , $request->code);

        if(! $otp2->status){
            session()->flash('failed' , 'فشلت عمليه التحقق ,من فضلك ادخل الرمز الصحيح');
            return redirect()->back();
        }

        session(['email'=>$request->email]);
        return redirect()->route('admin.password.resetform.outside');

    }

}
