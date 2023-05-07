<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Stamp_masterResource extends JsonResource
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
            'country_id' => $this->country_id,
            'stapm_point' => $this->stapm_point,
            'image_of_loyalty_card' => $this->image_of_loyalty_card,
            'setup_level' => $this->setup_level,
            'daily_limit' => $this->daily_limit,
            'welcome_stamp' => $this->welcome_stamp,
            'birthday_step' => $this->birthday_step,
            'bonus_stamp' => $this->bonus_stamp,
            'stapm_expired' => $this->stapm_expired,
            'point_per_stamp' => $this->point_per_stamp,
            'currency' => $this->currency,
            'ration_of_cash_out' => $this->ration_of_cash_out,
            'message_eng' => $this->message_eng,
            'message_italian' => $this->message_italian,
            'message_greek' => $this->message_greek,
            'message_albanian' => $this->message_albanian,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
