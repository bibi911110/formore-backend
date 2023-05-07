<?php

namespace App\Http\Requests\API;

use App\Models\Other_program_master;
use InfyOm\Generator\Request\APIRequest;

class CreateOther_program_masterAPIRequest extends APIRequest
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
        return Other_program_master::$rules;
    }
}
