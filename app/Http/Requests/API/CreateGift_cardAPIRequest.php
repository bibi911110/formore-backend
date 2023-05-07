<?php

namespace App\Http\Requests\API;

use App\Models\Gift_card;
use InfyOm\Generator\Request\APIRequest;

class CreateGift_cardAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Gift_card::$rules;
    }
}
