<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Social_iconResource extends JsonResource
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
            'name' => $this->name,
            'social_icon' => $this->social_icon,
            'link' => $this->link,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
