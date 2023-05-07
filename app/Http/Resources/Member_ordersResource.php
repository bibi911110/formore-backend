<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Member_ordersResource extends JsonResource
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
            'order_details' => $this->order_details,
            'delivery_address' => $this->delivery_address,
            'member_comments' => $this->member_comments,
            'advance_payment' => $this->advance_payment,
            'points' => $this->points,
            'cash' => $this->cash,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
