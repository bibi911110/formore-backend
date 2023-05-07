<?php

namespace App\Http\Requests\API;

use App\Models\App_screen_information;
use InfyOm\Generator\Request\APIRequest;

class CreateApp_screen_informationAPIRequest extends APIRequest
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
        return App_screen_information::$rules;
    }
}
