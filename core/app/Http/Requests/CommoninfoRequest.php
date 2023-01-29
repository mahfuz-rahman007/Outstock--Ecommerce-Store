<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommoninfoRequest extends FormRequest
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
            'number' => 'required|max:250',
            'email' => 'required|max:250',
            'contactemail' => 'required|max:250',
            'base_color' => 'required',
            'header_logo' => 'mimes:jpeg,jpg,png',
            'footer_logo' => 'mimes:jpeg,jpg,png',
            'fav_icon' => 'mimes:jpeg,jpg,png',
            'breadcrumb_image' => 'mimes:jpeg,jpg,png'
        ];
    }
}
