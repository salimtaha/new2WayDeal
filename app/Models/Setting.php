<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts =[
        'phone'=>'array',
    ];

    public static function filterUpdateSetting($request) :array
    {
        return [
            'title'=>'string|required',
            'copyright'=>'string|required',
            'description'=>'string|required',
            'withdrawal_email'=>'required|email',
            'info_email'=>'required|email',
            'support_email'=>'required|email',
            'phone'=>'required|array',
            'logo'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'favicon'=>'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facebook'=>'string|nullable',
            'twitter'=>'string|nullable',
            'instagram'=>'string|nullable',
            'youtupe'=>'string|nullable',
            'tiktok'=>'string|nullable',
        ];
    }



}
