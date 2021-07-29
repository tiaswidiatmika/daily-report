<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFromTemplate extends FormRequest
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
        $template = \App\Models\Template::find(FormRequest::get('templateId'));
        $inputs = $template->setupInputs();

        // * get dynamic columns from template model method 'setupInputs()'
        // * make a new variable to hold the specified resource, but using collect()
        // * iterate through new variable, modify each value using key => value, 
        // * key => value is item => 'required'
        $tryToValidate = [];
        collect( $inputs )->map( function($item) {
            $tryToValidate[$item] = 'required';
        } );
        return $tryToValidate;
        
    }
}
