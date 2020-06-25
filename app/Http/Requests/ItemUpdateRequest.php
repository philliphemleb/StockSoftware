<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:255',
            'amount' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('item.name_required'),
            'description.required' => __('item.description_required'),
            'amount.required' => __('item.amount_required'),
            'amount.integer' => __('item.amount_too_high')
        ];
    }
}
