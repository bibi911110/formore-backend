<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Other_program_masterResource extends JsonResource
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
            'type_code' => $this->type_code,
            'upload_photo' => $this->upload_photo,
            'surname' => $this->surname,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
