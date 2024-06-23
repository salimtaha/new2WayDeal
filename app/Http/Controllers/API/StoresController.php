<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StoresResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $stores = Store::all();
        return SendResponse(200,'Stores fetched successfully',[
            'stores_count'=>$stores->count(),
            'stores'=>StoresResource::collection($stores)
        ]
        );
    }
}
