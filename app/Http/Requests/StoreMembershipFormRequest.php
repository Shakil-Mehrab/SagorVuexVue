<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembershipFormRequest extends FormRequest
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
          
            "country_id"=>"required|integer",
            "city_id"=>"required|integer",
            "district_id"=>"required|integer",
            "company_name"=>"required|max:50",
            "category_id"=>"required|integer",  
            "address"=>"required",
            "detail"=>"required|min:10|max:2000",
            
        ];
    }
}
