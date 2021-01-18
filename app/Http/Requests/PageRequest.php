<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
           
            'name_page' => 'required',
            'view_id' => 'required',
            'utm_source' => 'required',
            'utm_medium' => 'required',
            
        ];
    }
    public function messages ()
    {
        return [
           
            'name_page.required' => 'Nhập Tên Page',
            'view_id.required' => 'Nhập viewID',
            'utm_source.required' => 'Nhập utm_source',
            'utm_medium.required' => 'Nhập utm_medium',
        ];
    }
}
