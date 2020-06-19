<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterUpdateRequest extends FormRequest
{
    protected $redirectRoute = 'filter.index';

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
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('filter.name_required'),
            'description.required' => __('filter.description_required'),
        ];
    }
}
