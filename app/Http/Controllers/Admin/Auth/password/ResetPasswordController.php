<?php

namespace App\Http\Controllers\Admin\Auth\password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function showResetForm()
    {
        $email = session('email');
        return view('admin.auth.passwords.reset' , compact('email'));
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password'=>['required' , 'min:8' , 'confirmed'],
        ]);


        $admin = Admin::where('email' , $request->email)->first();
        $admin->update([
            'password' => bcrypt($request->password),
        ]);

        session()->forget('email');


        session()->flash('success' , 'تم تعيين كلمه سر جديده بنجاح');
        return redirect()->route('admin.welcome');
    }
}
