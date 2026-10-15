<?php

namespace App\Http\Requests\Publisher;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePublisherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function preparedForValidation(): void
    {
        $name = $this->input('publisher_name');

        if(is_string($name)){
            $this->merge([
                'publisher_name' => preg_replace(
                    '/\s+/u', ' ',
                    trim($name)
                )
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'publisher_name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:publishers,publisher_name',
                // 'unique:table,column,except,id'
            ]
        ];
    }

    public function message(): array
    {
        return [
            'publisher_name.required' => 'The publisher name field is required.',
            'publisher_name.min' => 'The publisher must be at least 3 characters.',
            'publisher_name.max' => 'The publisher cannot be exceed 255 characters',
            'publisher_name.unique' => 'The publisher already exists'
        ];
    }
}