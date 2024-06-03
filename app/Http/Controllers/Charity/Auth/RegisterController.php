<?php

namespace App\Http\Controllers\Charity\Auth;

use App\Models\Charity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageUpload;
use App\Notifications\EmailVerificationCode;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:charity')->only(['showRegisterForm' , 'store' , 'showFormVerfication']);
    }

    public function showRegisterForm ()
    {
        return view('charity.auth.register');
    }

    public function store(Request $request)
    {
        $request->validate($this->filter());
        $data = $request->except(['password_confirmation' , 'terms']);
        $data['password'] = bcrypt($request->password);


        if($request->hasFile('health_certificate')){
            $data['health_certificate'] = ImageUpload::uploadImage($request->health_certificate , 'charities/certificates');
        }

        DB::beginTransaction();
        try{

            $charity = Charity::create($data);
            $charity->notify(new EmailVerificationCode());

            DB::commit();

        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

        return redirect()->route('charities.register.verify.form' , ['email'=>$charity['email']]);

    }

    public function showFormVerfication(Request $request)
    {
        return view('charity.auth.emails.verification' , compact('request'));
    }

    public function filter():array
    {
        return [
            'name'=>'required|unique:charities,name',
            'email'=>'email|unique:charities,email',
            'governorate_id'=>'required|exists:governorates,id',
            'city_id'=>'required|exists:cities,id',
            'description'=>'required',
            'password'=>'required|confirmed|min:8|max:50',
            'password_confirmation'=>'required',
            'terms'=>'required',
            'health_certificate'=>'required|image|max:2048',
            'phone'=>'required',
        ];
    }
}
