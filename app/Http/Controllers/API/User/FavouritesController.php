<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\FavouritesResource;
use Illuminate\Http\Request;

class FavouritesController extends Controller
{
    public function index()
    {
        $favourites = auth()->user()->favourites()->with('seller')->get();

        return SendResponse(200, 'Favourites retrieved successfully', FavouritesResource::collection($favourites));
    }

    public function store(Request $request)
    {
        $request->validate([
            'seller_id' => 'required|exists:stores,id'
        ]);

        $is_favourite = auth()->user()->favourites()->where('store_id', $request->seller_id)->first();

        if ($is_favourite) {
            return SendResponse(400, 'This seller is already in your favourites');
        }

        auth()->user()->favourites()->create([
            'store_id' => $request->seller_id
        ]);

        return SendResponse(200, 'Seller is added to your favourites successfully');
    }

    public function destroy($favourite)
    {
        $favourite = auth()->user()->favourites()->where('store_id', $favourite)->first();

        if (!$favourite) {
            return SendResponse(400, 'This seller is not in your favourites');
        }

        $favourite->delete();

        return SendResponse(200, 'Seller is removed from your favourites successfully');
    }
}
