<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\SellerOrdersResource;

class OrdersController extends Controller
{
    public function index()
    {
        return SellerOrdersResource::collection(auth()->user()->products()->with('orders')->get()->pluck('orders')->flatten());
    }
}
