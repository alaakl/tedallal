<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
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
            'city' => ['required', 'string'],
            'street' => ['required', 'string'],
            'block' => ['required',],
            'building' =>['required',],
            'floor' => ['required',],
            'site_num'=> ['required',],
            'type'=> ['required',],
            'products.*' => ['exists:products,id'],
            'delivary_price' => ['required', 'numeric'],
            'payment_method_id' => ['required', 'exists:payment_methods_lockup,id'],
            'quantity.*' => ['numeric', 'min:1']

        ];
    }
}
