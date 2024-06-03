<?php

namespace App\Http\Controllers\Charity\Profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $charity = Auth::guard('charity')->user();
        return view('charity.profile.index', compact('charity'));
    }

    public function update(Request $request)
    {
        $request->validate($this->filter());

        $charity = $request->user('charity');
        $charity->update($request->all());

        session()->flash('success', 'تم تحديث الملف الشخصي بنجاح');
        return redirect()->route('charities.profile.index');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image'=>'max:1024',
        ]);

        if(!$request->hasFile('image')){

            return redirect()->back()->withErrors(['error'=>' حاول مره اخرى ']);

        }

        $path = ImageUpload::uploadImage($request->image , 'charities/profiles' , $request->user('charity')->image);

        $charity = $request->user('charity');
        $charity->update(['image'=>$path]);

        session()->flash('success', 'تم تحديث صوره الملف الشخصي بنجاح');
        return redirect()->route('charities.profile.index');

    }
    public function filter()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],
            'phone' => ['required', 'numeric'],
            'description' => ['required', 'string', 'min:10', 'max:400'],
            'governorate_id' => ['required', 'exists:governorates,id'],
            'city_id' => ['required', 'exists:cities,id'],
            'email' => ['required', 'email', 'unique:charities,email,' . (Auth::guard('charity')->user()->id ?? 'NULL') . ',id'],
            'address' => ['required', 'string', 'min:5', 'max:100'],
        ];
    }
}
