<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FilterRequest extends FormRequest
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
            'filter_by_delivery_price' => ['numeric'],
            'user_latitude' => ['numeric', ],
            'user_longitude' => ['numeric',],
            'filter_by_distance' => ['numeric', 'min:1'],
            'filter_by_location' => ['string'],
        ];
    }
}
