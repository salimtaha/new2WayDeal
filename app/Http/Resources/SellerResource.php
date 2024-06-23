<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
        [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'balance' => number_format($this->account->value, 2). ' EGP',
            'balance_status' => $this->account->status == 'enable' ? true : false,
            'rate' => number_format($this->rates->avg('value'), 1) > 0 ? number_format($this->rates->avg('value'), 1) : "No Rates Yet",
            'sales' => OrderDetail::whereHas('product', function($q) {
                $q->where('store_id', $this->id);
            })->count() > 0 ? OrderDetail::whereHas('product', function($q) {
                $q->where('store_id', $this->id);
            })->count() : "No Sales Yet",
            'address' => $this->street . ', ' . $this->city->name . ', ' . $this->governorate->name,
            'image'=> url('uploads/'.$this->image),
            'certificates' =>
            [
                'health_approval_certificate' => url('uploads/'.$this->health_approval_certificate),
                'commercial_resturant_license' => url('uploads/'.$this->commercial_resturant_license),
            ],
            'joined_from' => $this->created_at->diffForHumans(),
            'verified_from' => $this->email_verified_at->diffForHumans(),
            'products' =>
            [
                'count' => $this->products->count(),
                'data' => ProductsResource::collection($this->products),
            ],
        ];
    }
}
