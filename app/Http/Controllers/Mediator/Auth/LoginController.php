<?php

namespace App\Http\Controllers\Mediator\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public $redirectTo = RouteServiceProvider::MediatorHome;
    public function __construct()
    {
        $this->middleware(['guest:mediator'])->except('logout');
    }
    public function showLoginForm()
    {
        return view('mediator.auth.login');
    }

    public function check(Request $request)
    {
        $request->validate($this->filter() , $this->customFilter());

        if (Auth::guard('mediator')->attempt($request->only(['email', 'password']))) {

            return redirect()->intended($this->redirectTo);
        } else {

            return redirect()->route('mediators.showLogin')
                ->withInput(['email'=>$request->email])
                ->withErrors(['email' => 'بيانات الاعتماد غير متطابقه !']);
        }
    }

    private function filter()
    {
        return [
            'email' => 'required|string',
            'password' => 'required|min:8',
            // 'g-recaptcha-response' => 'required',
        ];
    }
    public function customFilter()
    {
        return [
            'g-recaptcha-response' => [
                'required' => 'يرجى التاكد من انك لست ريبورت معلش كل واحد يضمن حقه',
                // 'captcha' => 'خطا في التحقق ,  حاول مره اخرى .',
            ],
        ];
    }
    public function logout()
    {
        Auth::guard('mediator')->logout();
        return redirect()->route('mediators.showLogin');
    }
}
