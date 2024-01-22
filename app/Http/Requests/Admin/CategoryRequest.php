<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ];

        if($this->isMethod('patch')){
            unset($rules);
            $rules = [
                'name'      =>  'sometimes|max:191',
                'parent_id' =>  'sometimes|not_in:0',
                'image'     =>  'mimes:jpg,jpeg,png|max:1000'
            ];
        }

        return $rules;
    }
}
