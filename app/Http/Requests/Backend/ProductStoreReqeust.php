<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreReqeust extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'thumb_image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_info' => ['required', 'max: 600'],
            'long_info' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_info' => ['nullable','max:250'],
            'status' => ['required']
        ];
    }
}
