<?php

namespace App\Http\Requests\Sales;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'quantity' => [
                'required',
                'integer',
                'gt:0'
            ],
            'unit_cost' => [
                'required',
                'numeric',
                'gt:0'
            ],
            'product' => [
                'required',
                'numeric',
                'exists:products,id'
            ],
        ];
    }
}
