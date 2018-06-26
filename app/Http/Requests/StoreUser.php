<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
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
        $id = $this->route('user')  ? ',email,' . $this->route('user') : '';

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users' . $id,
            'roles' => 'required',
            'cities' => 'required',
        ];

        if (empty($id) || request('password')) {
            $rules['password'] = 'sometimes|required|min:8';
        }

        return $rules;
    }
}
