<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageUpload;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.pages.settings.update');
    }
    public function update(Request $request, $id)
    {

        $request->validate(Setting::filterUpdateSetting($request));

        $setting = Setting::findOrFail($id);
        $setting->update($request->except(['logo', 'favicon']));

        if ($request->hasFile('logo')) {
            $setting->update(['logo' => ImageUpload::uploadImage($request->file('logo') , 'settings/logo', $setting->logo)]);
        }
        if ($request->hasFile('favicon')) {
            $setting->update(['favicon' => ImageUpload::uploadImage($request->file('favicon') ,'settings/favicon' , $setting->favicon)]);
        }

        session()->flash('success' , 'تم تحديث اعدادات الموقع بنجاح');
        return redirect()->route('admin.settings.index');


    }
}
