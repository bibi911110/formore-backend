<?php

namespace App\Http\Requests\API;

use App\Models\Notification_details;
use InfyOm\Generator\Request\APIRequest;

class UpdateNotification_detailsAPIRequest extends APIRequest
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
        $rules = Notification_details::$rules;
        
        return $rules;
    }
}
