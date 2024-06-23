<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrdersResource;
use App\Models\Order;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->paginate(10);

        return SendResponse(200,'Orders from '. $orders->firstItem() . ' to ' . $orders->lastItem() . ' fetched successfully',[
            'orders_count' => $orders->total(),
            'orders' => OrdersResource::collection($orders),
            'pagination' =>[
                    'next_page_url' => $orders->nextPageUrl(),
                    'prev_page_url' => $orders->previousPageUrl(),
                    'last_page_url' => $orders->url($orders->lastPage()),
                    'first_page_url' => $orders->url(1),
                    'per_page' => $orders->perPage(),
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'from' => $orders->firstItem(),
                    'to' => $orders->lastItem()
                ]
        ]);
    }

    public function show($order)
    {
        $order = Order::find($order);

        if(!$order)
        {
            return SendResponse(404,'Order not found');
        }


        if(auth()->id() != $order->user_id)
        {
            return SendResponse(403,'You are not authorized to view this order');
        }

        return SendResponse(200,'Order fetched successfully',new OrdersResource($order));
    }
}
