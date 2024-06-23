<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CitiesResource;
use App\Models\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        if ($request->has('governorate_id')) {
            return SendResponse(200,
            'Cities fetched successfully',
            CitiesResource::collection(City::where('governorate_id', $request->governorate_id)->get()));
        }

        return SendResponse(422,
        'Please Provide Governorate ID');
    }
}
