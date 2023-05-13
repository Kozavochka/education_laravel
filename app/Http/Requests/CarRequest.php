<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
{
    // правила валидации
    public function rules()
    {
        return [
            // валидация
            'name'=>['required','string',
                //Ингор для обновления, чтобы можно было применить patch запрос
                Rule::unique('cars')->ignore($this->route('car')),
            ],
            'year'=>'nullable|between:1900,2023|integer',
            'is_new'=>'boolean',
            'price' => ['required','numeric', 'min:1', 'regex:/^\d+(\.\d{1,2})?$/']
        ];
    }

    public function prepareData()
    {
        return $this->validated();
    }
}
