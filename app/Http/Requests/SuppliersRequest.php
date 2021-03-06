<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SuppliersRequest extends Request
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
          'name_company' => 'required',
          'address' => 'required',
          'handphone'  => 'required',
          'telp'  => 'required',
          'photo'  => 'max:2000|mimes:jpeg,gif,png',
          'active'  => 'required',
      ];

      $last    = \GLobalHelp::idUrlEdit();

      if(!empty($last)) :
          $rules['email'] = 'required|email|unique:suppliers,email,'.$last.',supplier_id';
          $rules['website'] = 'required|unique:suppliers,website,'.$last.',supplier_id';
      else :
          $rules['email'] = 'required|email|unique:suppliers,email';
          $rules['website'] = 'required|unique:suppliers,website';
      endif;

      return $rules;
    }
}
