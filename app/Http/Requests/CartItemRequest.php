<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartItemRequest extends FormRequest
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
                'number' => 'required|numeric',
                'product_id' => 'required|numeric|exists:products,id',
            ];
        }
        else{
            return [
                'number' => 'numeric',
                'product_id' => 'numeric|exists:products,id',
            ];
        }
    }
}
