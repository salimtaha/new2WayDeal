<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.pages.profile.update', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3|max:60',
            'user_name'=>['required' , 'unique:admins,user_name,' . (Auth::guard('admin')->user()->user_name ?? 'NULL') . ',user_name'],
            'email'=>['required' , 'email' , 'unique:admins,email,' . (Auth::guard('admin')->user()->id ?? 'NULL') . ',id'],
        ]);


        if (Hash::check($request->old_password, Auth::guard('admin')->user()->password)) {

            if ($request->password) {
                $request->validateWithBag('pass', [
                    'password' => 'required|confirmed|min:8',
                    'password_confirmation' => 'required',
                ]);
                $request['password'] = bcrypt($request->password);
                $user = Admin::where('id', $request->id)->first();
                $user->update($request->only(['name', 'email', 'user_name', 'password']));
            } else {
                $user = Admin::where('id', $request->id)->first();
                $user->update($request->only(['name', 'email', 'user_name']));
            }
        } else {
            session()->flash('failed', 'كلمه السر الحاليه غير صحيحه !!');
            return redirect()->back();
        }

        session()->flash('success', ' تم تعدبل البيانات بنجاح!!');
        return redirect()->back();


    }
}
