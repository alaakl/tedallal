<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type_id' => ['exists:types,id'],
            'name' => ['required', 'string'],
            'image' => ['required', 'mimes:jpg,png,jpeg'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string'],
        ];
    }
}
