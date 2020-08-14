<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class clientRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'birthday' => 'required',
            'domicile' => 'required',
            'father_name' => 'required',
            'mother_first_name' => 'required',
            'mother_last_name' => 'required'/*,
            'moral_person_name' => 'required',
            'moral_person_description' => 'required'*/
        ];
    }
}
