<?php

namespace App\Http\Controllers\Admin\Operations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LatestOperationController extends Controller
{
    public function index()
    {
        return view('admin.pages.latest-operation.index');
    }
}
