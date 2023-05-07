<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Voucher_upload_receiptResource extends JsonResource
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
            'business_id' => $this->business_id,
            'user_id' => $this->user_id,
            'voucher_id' => $this->voucher_id,
            'vat_number' => $this->vat_number,
            'date_of_purchase' => $this->date_of_purchase,
            'time' => $this->time,
            'upload_receipt' => $this->upload_receipt,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
