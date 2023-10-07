<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLightDeliveryRequest extends FormRequest
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
            'source_city' => ['required', 'string'],
            'source_street' => ['required', 'string'],
            'source_block' => ['required',],
            'source_building' =>['required',],
            'source_floor' => ['required',],
            'source_site_num'=> ['required',],
            'source_type'=> ['required',],

            'distination_city' => ['required', 'string'],
            'distination_street' => ['required', 'string'],
            'distination_block' => ['required',],
            'distination_building' =>['required',],
            'distination_floor' => ['required',],
            'distination_site_num'=> ['required',],
            'distination_type'=> ['required',],

            'title'=> ['required',],
            'description'=> ['required',],
        ];
    }
}
