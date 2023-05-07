<?php

namespace App\Http\Requests\API;

use App\Models\Order_product_extra_details;
use InfyOm\Generator\Request\APIRequest;

class CreateOrder_product_extra_detailsAPIRequest extends APIRequest
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
        return Order_product_extra_details::$rules;
    }
}
