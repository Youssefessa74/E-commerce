<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class VendorProfileUpdateReqeust extends FormRequest
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
            'phone' => 'required|max:50', // Adjust max length as needed
            'email' => 'required|email|max:255|unique:users,email,'.$this->user_id,
            'banner' => 'nullable|image',
            'address' => 'required',
            'description' => 'nullable',
            'fb_link' => 'nullable|url',
            'tw_link' => 'nullable|url',
            'insta_link' => 'nullable|url',
             'user_id' => 'required|exists:users,id', // Assuming user_id is a foreign key
             'status' => 'boolean',
        ];
    }
}
