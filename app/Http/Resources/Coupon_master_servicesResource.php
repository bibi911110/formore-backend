<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Coupon_master_servicesResource extends JsonResource
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
            'coupon_code' => $this->coupon_code,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'amount_type' => $this->amount_type,
            'amount' => $this->amount,
            'amount_discount' => $this->amount_discount,
            'points_discount' => $this->points_discount,
            'coupon_info' => $this->coupon_info,
            'created_by' => $this->created_by,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
