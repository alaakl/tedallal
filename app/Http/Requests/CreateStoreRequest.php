<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'image' => ['required', 'mimes:jpg,png,jpeg'],
//            'minimum_cost' => [] , must be nullable in database
//            'recommended' => [],must be nullable in database
//            'status' =>   [],must be nullable in database
            'description' => ['string'],
            'city'  =>    ['required', 'string'],
            'street'  => ['required'],
            'block'  =>   ['required'],
            'building'  =>  ['required'],
//            'floor'  =>   [],must be nullable in database
            'site_num' =>  ['required'],
            'commercial_record_image' => ['required', 'mimes:jpg,png,jpeg'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
