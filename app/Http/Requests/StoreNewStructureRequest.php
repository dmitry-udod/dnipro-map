<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreNewStructureRequest extends FormRequest
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
            'email' => 'required|email',
            'address' => 'required',
            'description' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'photos.*' => 'sometimes|mimes:jpg,jpeg,png,gif|size:20000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Вкажiть iм\'я',
            'address.required' => 'Вкажiть адресу',
            'email.required' => 'Вкажiть електронну пошту',
            'email.email' => 'Невiрний формат електронної пошти',
            'description.required' => 'Опишiть проблему',
            'photos.*.size' => [
                'unique' => 'Максимальний розмiр файла 20 Мб',
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new \Illuminate\Http\Exceptions\HttpResponseException(response()->json(['error' => $validator->errors()->first()], 422));
    }
}
