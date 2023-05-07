<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order_productsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cat_id' => $this->cat_id,
            'name' => $this->name,
            'product_img' => $this->product_img,
            'ingredients_name' => $this->ingredients_name,
            'available_quantities' => $this->available_quantities,
            'price_per_quantity' => $this->price_per_quantity,
            'points_per_quantity' => $this->points_per_quantity,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
