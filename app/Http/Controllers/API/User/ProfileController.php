<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return SendResponse(200, 'Welcome Back, '.auth()->user()->name.'!', UserResource::make(auth()->user()));
    }

    public function update(UpdateProfileRequest $request)
    {
        auth()->user()->update($request->validated());
        return SendResponse(200, 'Profile updated successfully', UserResource::make(auth()->user()));
    }

    public function updatePic(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        ]);

        auth()->user()->update(
            [
                'image' => uploadImage($request->image, 'avatars', auth()->user()->image == 'default.png' || auth()->user()->image == 'default.jpg' ? null : auth()->user()->image),
            ]
        );

        return SendResponse(200, 'Profile picture updated successfully', UserResource::make(auth()->user()));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return SendResponse(422, 'The old password is incorrect');
        }

        auth()->user()->update(
            [
                'password' => bcrypt($request->password),
            ]
        );

        return SendResponse(200, 'Password updated successfully');
    }
}
