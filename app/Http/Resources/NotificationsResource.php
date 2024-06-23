<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationsResource extends JsonResource
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
        $data['title'] = $this->title;
        $data['created_at'] = $this->created_at->format('Y-m-d H:i:s');

        if($request->route()->getName() == 'seller.notification'){
            $data['last_updated'] = $this->updated_at->format('Y-m-d H:i:s');
            $data['body'] = $this->body;
        }

        return $data;
    }
}
