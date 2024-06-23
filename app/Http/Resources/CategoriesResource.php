<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
        $data['image'] = url($this->image);

        if($request->route()->getName() == 'category.show')
        {
            $data['description'] = $this->description;
            $data['products_count'] = $this->products->count();
            $data['products'] = ProductsResource::collection($this->products);
        }

        return $data;
    }
}
