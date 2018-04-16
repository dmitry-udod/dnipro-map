<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCity extends FormRequest
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
        $checkId = (int) $this->route('city') ? ',slug,' . $this->route('city') : '';

        return [
            'name' => 'required|max:255',
            'slug' => 'unique:cities' . $checkId,
        ];
    }
}
