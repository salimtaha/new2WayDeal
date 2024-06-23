<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavouritesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->seller->name,
            'image' => url('uploads/'.$this->seller->image),
            'rate' => number_format($this->seller->rates->avg('value'), 1) > 0 ? number_format($this->seller->rates->avg('value'), 1) : "-",
            'rate_with_reviews' => number_format($this->seller->rates->avg('value'), 1) > 0 ? number_format($this->seller->rates->avg('value'), 1)."({$this->seller->rates->count()} Reviews)" : "No Rates Yet",
        ];
    }
}
