<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreUserClaim extends FormRequest
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
            'phone' => 'required',
            'email' => 'required|email',
            'category' => 'required',
            'description' => 'required',
            'photos.*' => 'sometimes|mimes:jpg,jpeg,png,gif|max:20000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Вкажiть им\'я',
            'phone.required' => 'Вкажiть Контактный телефон',
            'email.required' => 'Вкажiть електронну пошту',
            'email.email' => 'Невiрний формат електронної пошти',
            'category.required' => 'Вкажiть категорiю',
            'description.required' => 'Опишiть проблему',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(['error' => $validator->errors()->first()], 422));
    }
}
