<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //'Name' => ['required', 'min:3', 'max:50'],
            'Name' => ['required', 'max:50'],

            //previous setup:
            // 'Email' => ['required', 'unique:person,email'],
            // 'Phone' => ['required', 'unique:person,phone']     

            //new setup: Two ways of implementation(P.S These are both working).

            //Setup 1: Model's Validation Rules
            //Requirements: None
            // 'Email' => ['required', 'unique:person,Email,' . $this->person->id],
            // 'Phone' => ['required', 'unique:person,Phone,' . $this->person->id]
            
            //Setup 2: Custom Validation Rules
            //Requirements: import the "use Illuminate\Validation\Rule;"
            'Email' => ['required', Rule::unique('person')->ignore($this->person)],
            'Phone' => ['required', Rule::unique('person')->ignore($this->person)]
        ];
    }
}
