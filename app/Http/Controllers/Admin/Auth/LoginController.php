<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Notifications\LoginNotification;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::AdminHome;

    public function __construct()
    {
        $this->middleware('guest:admin')->except(['logout']);
    }


    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function check(Request $request)
    {
        $request->validate($this->filter() , $this->customFilter());

        if (Auth::guard('admin')->attempt($request->only(['email' , 'password']))) {
            $user = auth('admin')->user();
            // $user->notify(new LoginNotification());
            return redirect()->intended($this->redirectTo);
        } else {

            return redirect()->route('admin.showLogin')
                ->withInput(['email' =>$request->email])
                ->withErrors(['email'=>'بيانات الاعتماد غير متطابقه.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLogin');
    }

    private function filter(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => [ 'required','string', 'required','min:8'],
            // 'g-recaptcha-response' => ['required']
        ];
    }

    public function customFilter()
    {
        return [
            'g-recaptcha-response' => [
                'required' => 'يرجى التاكد من انك لست ريبورت ',
                // 'captcha' => 'خطا في التحقق ,  حاول مره اخرى .',
            ],
        ];
    }

}
