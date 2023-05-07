<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Link_masterResource extends JsonResource
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
            'term_link' => $this->term_link,
            'privacy_link' => $this->privacy_link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
