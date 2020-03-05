<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        return [
            "name"=>"required|max:50",
            "price"=>"required|max:10000000",
            "qty"=>"required|integer|max:10000",            
            "discount"=>"required|between:0,99.99",            
            "brand"=>"required",            
            "detail"=>"required|min:10|max:2000",
            "size"=>"required",
            "category_id"=>"required|integer",
            "extra_price"=>"required|integer",
            "vat"=>"required|between:0,99.99",
        ];
    }
}
