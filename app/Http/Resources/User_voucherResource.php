<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User_voucherResource extends JsonResource
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
            'voucher_id' => $this->voucher_id,
            'user_id' => $this->user_id,
            'user_credit' => $this->user_credit,
            'stamps' => $this->stamps,
            'points' => $this->points,
            'used_code_status' => $this->used_code_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
