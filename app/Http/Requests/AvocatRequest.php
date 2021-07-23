<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvocatRequest extends FormRequest
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
            'title' => 'required',
            'presentation' => 'required|min:15|max:250',
            'adress' => 'required',
            'wilaya_id' => 'required',
        ];
    }
}
