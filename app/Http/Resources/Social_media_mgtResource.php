<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Social_media_mgtResource extends JsonResource
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
            'media_name' => $this->media_name,
            'media_category' => $this->media_category,
            'media_icon' => $this->media_icon,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
