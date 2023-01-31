<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectiontitleRequest extends FormRequest
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
            "trending_product_title"   => "required|max:150",
            "trending_product_sub_title"  => "required|max:300",

            "product_title"  => "required|max:150",
            "product_sub_title"  => "required|max:300",

            "blog_title"  => "required|max:150",
            "blog_sub_title"  => "required|max:300",

            "newsletter_title"  => "required|max:150",
            "newsletter_sub_title"  => "required|max:300",
        ];
    }
}
