<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Promotional_image_masterResource extends JsonResource
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
            'image_1' => $this->image_1,
            'counter_1' => $this->counter_1,
            'image_2' => $this->image_2,
            'counter_2' => $this->counter_2,
            'image_3' => $this->image_3,
            'counter_3' => $this->counter_3,
            'image_4' => $this->image_4,
            'counter_4' => $this->counter_4,
            'image_5' => $this->image_5,
            'counter_5' => $this->counter_5,
            'from_date' => $this->from_date,
            'to_date' => $this->to_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
