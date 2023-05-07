<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Loyalty_banner_masterResource extends JsonResource
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
            'terms_of_loyalty' => $this->terms_of_loyalty,
            'schema' => $this->schema,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
