<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Booked_servicesResource extends JsonResource
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
            'member_name' => $this->member_name,
            'member_id' => $this->member_id,
            'service_name' => $this->service_name,
            'booking_service_date_time' => $this->booking_service_date_time,
            'comments' => $this->comments,
            'advance_payment' => $this->advance_payment,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
