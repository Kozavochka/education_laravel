<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id' => [
                'required',
                'integer',
                Rule::exists('users','id'),
            ],
            'description' => [
                'string',
            ],
            'cars' => [
                'array',
                'required',
            ],
            'cars.*' => [
                'integer',
                Rule::exists('cars','id'),
            ]
        ];
    }
}
