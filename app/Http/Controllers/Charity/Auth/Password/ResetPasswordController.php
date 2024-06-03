<?php

namespace App\Http\Controllers\Charity\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Charity;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('charity.auth.passwords.reset' , compact('request'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'=>['required' , 'min:8' , 'confirmed'],
        ]);


        $charity = Charity::where('email' , $request->email)->first();
        $charity->update([
            'password' => bcrypt($request->password),
        ]);

        session()->flash('successResetPassword' , '😊تم تعيين كلمه سر جديده بنجاح');
        return redirect()->route('charities.showLogin');
    }
}
