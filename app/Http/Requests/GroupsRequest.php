<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GroupsRequest extends Request
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
            $rules['group_name'] = 'required|unique:groups,group_name,'.$last.',group_id';
            // $rules['order'] = 'required';
        else :
            $rules['group_name'] = 'required';
            // $rules['order'] = 'required';
        endif;

        return $rules;
    }
}
