<?php

namespace App\Http\Requests\Book;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class BookRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:50'
            ],

            'slug' => [
                'required',
                'string',
                'max: 50',
                'alpha_dash:ascii',
                Rule::unique('book', 'slug')
            ],

            'isbn' => [
                'required',
                'string'
            ],

            'price' => [
                'required',
                'decimal'
            ],

            'description' => [
                'text',
                'max:100'
            ],

            'author_id' => [
                'required',
                'exists:author_id'
            ],

            'image' => [
                'mimes:jpg,jpeg,png,gif,webp,avif',
                'max:2048',
                'nullable'
            ],

            'publisher_id' => [
                'required',
                'exist:publishers,id'
            ]
        ];
    }
}
