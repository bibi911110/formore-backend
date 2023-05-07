<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Points_masterResource extends JsonResource
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
            'schema' => $this->schema,
            'currency_id' => $this->currency_id,
            'ratio_of_collecting_points' => $this->ratio_of_collecting_points,
            'ratio_for_cash_out' => $this->ratio_for_cash_out,
            'segments_id' => $this->segments_id,
            'levels_based_on_scenarios' => $this->levels_based_on_scenarios,
            'birthday' => $this->birthday,
            'welcome' => $this->welcome,
            'fraud_of_points' => $this->fraud_of_points,
            'campaign' => $this->campaign,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'choose_segments' => $this->choose_segments,
            'expiration_date' => $this->expiration_date,
            'message_eng' => $this->message_eng,
            'message_italian' => $this->message_italian,
            'message_greek' => $this->message_greek,
            'message_albanian' => $this->message_albanian,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
