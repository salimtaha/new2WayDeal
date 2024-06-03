<?php

namespace App\Http\Controllers\Charity\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Notifications\LoginNotification;

class LoginController extends Controller
{

    protected $redirectTo = RouteServiceProvider::CharityHome;
    public function __construct()
    {
        $this->middleware('guest:charity')->except(['logout']);
    }


    public function showLoginForm()
    {
        return view('charity.auth.login');
    }

    public function check(Request $request)
    {

        $request->validate($this->filter() , $this->customFilter());

        if (Auth::guard('charity')->attempt($request->only(['email', 'password']))) {
            $user = auth('charity')->user();
            // $user->notify(new LoginNotification());
            return redirect()->intended($this->redirectTo);
        } else {

            return redirect()->route('charities.showLogin')
                ->withInput(['email' => $request->email])
                ->withErrors(['error' => 'بيانات الاعتماد غير متطابقه.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('charity')->logout();
        return redirect()->route('charities.showLogin');
    }

    private function filter(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['string', 'required', 'min:8'],
            'g-recaptcha-response' => ['required']
        ];
    }

    public function customFilter()
    {
        return [
            'g-recaptcha-response' => [
                'required' => 'يرجى التاكد من انك لست ريبورت معلش ',
                // 'captcha' => 'خطا في التحقق ,  حاول مره اخرى .',
            ],
        ];
    }
}
