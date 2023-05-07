<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Extra_servicesResource extends JsonResource
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
            'services_name' => $this->services_name,
            'services_per_price' => $this->services_per_price,
            'services_per_point' => $this->services_per_point,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
