<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
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
            'group_id' => 'required',
            'active' => 'required',
            'name'  => 'required',
            'photo'  => 'max:2000|mimes:jpeg,gif,png'
        ];

        $last    = \GLobalHelp::idUrlEdit();  

        if(!empty($last)) : 
            $rules['username'] = 'required|unique:users,username,'.$last.',id';
            $rules['password'] = 'confirmed';
            $rules['email'] = 'required|email|unique:users,email,'.$last.',id';
        else :
            $rules['username'] = 'required|unique:users,username';
            $rules['password'] = 'required|confirmed';
            $rules['email'] = 'required|email|unique:users,email';
        endif;

        return $rules;
    }
}
