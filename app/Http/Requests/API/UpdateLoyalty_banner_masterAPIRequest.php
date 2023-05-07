<?php

namespace App\Http\Requests\API;

use App\Models\Loyalty_banner_master;
use InfyOm\Generator\Request\APIRequest;

class UpdateLoyalty_banner_masterAPIRequest extends APIRequest
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
        $rules = Loyalty_banner_master::$rules;
        
        return $rules;
    }
}
