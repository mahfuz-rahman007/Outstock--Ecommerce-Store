<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeoinfoRequest extends FormRequest
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
            'meta_keywords' => 'required',
            'meta_description' => 'required'
        ];
    }
}
