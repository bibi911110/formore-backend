<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Refer_business_detailsResource extends JsonResource
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
            'name_of_business' => $this->name_of_business,
            'owner_email' => $this->owner_email,
            'your_name' => $this->your_name,
            'your_email' => $this->your_email,
            'term_check' => $this->term_check,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
