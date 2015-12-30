<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemsCategoryRequest extends Request
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
        $rules = [
            'description' => 'required',
        ];
        $last    = \GLobalHelp::lastUrl();

        if(is_numeric($last)) :
            $rules['name_category'] = 'required|unique:items_category,name_category,'.$last.',item_category_id';
        else :
            $rules['name_category'] = 'required';
        endif;

        return $rules;
    }
}
