<?php

namespace App\Http\Requests\API;

use App\Models\Gift_vocher_types;
use InfyOm\Generator\Request\APIRequest;

class CreateGift_vocher_typesAPIRequest extends APIRequest
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
        return Gift_vocher_types::$rules;
    }
}
