<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data =
        [
            'id' => $this->id,
            'status'=> $this->status,
            'icon' =>
                $this->status == 'pending' ? 'Icons.pending' :
                ($this->status == 'not_received' ? 'Icons.error_outline' :
                ($this->status == 'completed' ? 'Icons.check' :
                ($this->status == 'paid' ? 'Icons.payments' : 'Icons.highlight_off'))),
            'icon_color' =>
                $this->status == 'pending' ? '0xffFFDE00' :
                ($this->status == 'not_received' ? '0xffdc3545' :
                ($this->status == 'completed' ? '0xff28a745' :
                ($this->status == 'paid' ? '0xff007bff' : '0xff6c757d'))),
            'net_price' => number_format($this->total_price + $this->shipping_price,2),
            'ordered_from' => Carbon::parse($this->created_at)->diffForHumans(),
        ];

        if($request->routeIs('order.show'))
        {

            $data['shipping'] = $this->shipping ? true : false;
            $data['total_price'] = number_format($this->total_price,2);
            $data['shipping_price'] = number_format($this->shipping_price,2);
            $data['payment_method'] = $this->payment_method;
            $data['address'] = $this->address . ', ' . $this->city->name . ', ' . $this->governorate->name;
            $data['phone'] = '0'.$this->phone;
            $data['products'] = $this->products->map(function($product){
                return [
                    'id' => $product->id,
                    'product_name' => $product->product_name,
                    'quantity' => $product->product_quantity,
                    'product_price' => number_format($product->product_price,2),
                    'image' => $product->product->images[0]->image ? url($product->product->images[0]->image) : null,
                ];
            });
        }

        return $data;
    }
}
