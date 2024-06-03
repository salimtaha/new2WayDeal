<?php

namespace App\Http\Controllers\Admin\Alert;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class AlertStoreController extends Controller
{
    public function show($id)
    {
        $store = Store::findOrFail($id);
        return view('admin.pages.alerts.send' , compact('store'));
    }
}
