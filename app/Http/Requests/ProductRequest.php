<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        if ($this->isMethod('post')){
            return [
                'name' => 'required|max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ِِِِِِِِِِِِِِِء-ي., ]+$/u',
                'description' => 'required|max:300|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟ ]+$/u',
                'user_id' => 'numeric|exists:users,id',
                'category_id' => 'numeric|exists:categories,id',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'marketable' => 'required|numeric|in:0,1',
                'tags' => 'nullable|regex:/^[ا-یa-zA-Z0-9\ِِِِِِِِِِِِِِِء-ي., ]+$/u',
                'price' => 'required|numeric',
                'sold_number' => 'required|numeric',
                'frozen_number' => 'required|numeric',
                'marketable_number' => 'required|numeric',
            ];
        }
        else{
            return [
                'name' => 'max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ِِِِِِِِِِِِِِِء-ي., ]+$/u',
                'description' => 'max:300|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟ ]+$/u',
                'user_id' => 'numeric|exists:users,id',
                'category_id' => 'numeric|exists:categories,id',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'numeric|in:0,1',
                'marketable' => 'numeric|in:0,1',
                'tags' => 'nullable|regex:/^[ا-یa-zA-Z0-9\ِِِِِِِِِِِِِِِء-ي., ]+$/u',
                'price' => 'numeric',
                'sold_number' => 'numeric',
                'frozen_number' => 'numeric',
                'marketable_number' => 'numeric',
            ];
        }
    }
}
