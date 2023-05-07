<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Nfc_masterResource extends JsonResource
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
            'nfc_code' => $this->nfc_code,
            'nfc_url' => $this->nfc_url,
            'linked_url' => $this->linked_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
