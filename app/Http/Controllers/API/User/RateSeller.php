<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\StoreRate;
use Illuminate\Http\Request;

class RateSeller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric|min:1|max:5',
            'store_id' => 'required|exists:stores,id',
        ]);

        StoreRate::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'store_id' => $request->store_id,
            ],
            [
                'value' => $request->value,
            ]
        );

        return SendResponse(200, 'Store rated successfully');
    }
}
