<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ItemsRequest extends Request
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
            'supplier_id' => 'required',
            'category_id' => 'required',
            'price_buy'   => 'required',
            'price_selling'   => 'required',
            'stok'          => 'required',
            'note'          => 'required'
        ];
        $last    = \GLobalHelp::lastUrl();  

        if(is_numeric($last)) : 
            $rules['name_items'] = 'required';
        else :
            $rules['name_items'] = 'required';
        endif;

        return $rules;
    }
}
