<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User_business_detailsResource extends JsonResource
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
            'user_id' => $this->user_id,
            'header_banner' => $this->header_banner,
            'business_name' => $this->business_name,
            'map_link' => $this->map_link,
            'user_available_points' => $this->user_available_points,
            'e_shop_banner' => $this->e_shop_banner,
            'booking_banner' => $this->booking_banner,
            'logo' => $this->logo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
