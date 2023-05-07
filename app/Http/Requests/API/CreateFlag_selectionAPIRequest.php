<?php

namespace App\Http\Requests\API;

use App\Models\Flag_selection;
use InfyOm\Generator\Request\APIRequest;

class CreateFlag_selectionAPIRequest extends APIRequest
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
        return Flag_selection::$rules;
    }
}
