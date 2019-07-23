<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StorePreviousRecordRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'age' => 'required',
            'parent_name' => 'required',
            'parent_phone' => 'required',
            'date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Вкажiть iм\'я',
            'age.required' => 'Вкажiть вiк дитини',
            'parent_name.required' => 'Вкажiть iм\'я дорослого',
            'parent_phone.email' => 'Вкажiть телефон',
            'date.required' => 'Оберi дату',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(['error' => $validator->errors()->first()], 422));
    }
}
