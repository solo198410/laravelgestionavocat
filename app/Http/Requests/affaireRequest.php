<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class affaireRequest extends FormRequest
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
            'presentation' => 'required|min:20',
            //'type' => 'required',
            'frais_affaire' => 'required',
            //'resultat' => 'required'
            'autorite_jud_comp' => 'required|max:100',
            //'name' => 'required|max: 255',
             //'email' => 'required|email|max: 255',
             //'message' => 'required',
        ];
    }

    /*
    public function messages(){
       return [
       'required' => 'The :attribute field is required.',
       'email' => 'The :attribute must be a valid :attribute address'
       ];
     }
     */
}
