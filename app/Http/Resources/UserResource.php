<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'profile_picture' => url('uploads/'.$this->image),
            'governorate' => $this->governorate ? $this->governorate->name : null,
            'city' => $this->city ? $this->city->name : null,
            'phone' => "0".$this->phone,
            'joined_from' => $this->created_at->diffforhumans(),
        ];
    }
}
