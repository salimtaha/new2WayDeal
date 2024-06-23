<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [];
        $data['id'] = $this->id;
        $data['name'] = $this->name;
        $data['price'] = number_format($this->price,2);
        $data['discount'] = number_format($this->descount,2);
        $data['net_price'] = number_format($this->price - $this->descount, 2);
        $data['images'] = $this->images->pluck('image')->map(function ($imageName) {
            return url('uploads/' . $imageName);
        });
        if($request->route()->getName() == 'product.show')
        {
            $data['description'] = $this->description;
            $data['available_for'] = now()->diffInDays($this->available_for, false).' days left (Until '.$this->available_for->format('Y-m-d').')';
            $data['expire_date'] = $this->expire_date->format('Y-m-d');
            $data['available_quantity'] = $this->quantity;
            $data['category']['id'] = $this->category->id;
            $data['category']['name'] = $this->category->name;
            $data['store']['id'] = $this->store->id;
            $data['store']['name'] = $this->store->name;
            $data['store']['address'] = $this->store->street . ', ' . $this->store->city->name . ', ' . $this->store->governorate->name;
            $data['store']['image'] = url('uploads/'.$this->store->image);
            $data['store']['phone'] = $this->store->phone;
            $data['store']['rate'] = number_format($this->store->rates->avg('value'), 1) > 0 ? number_format($this->store->rates->avg('value'), 1) : "-";
            $data['store']['rate_with_reviews'] = number_format($this->store->rates->avg('value'), 1) > 0 ? number_format($this->store->rates->avg('value'), 1)."({$this->store->rates->count()} Reviews)" : "No Rates Yet";
        }


        return $data;
    }
}
