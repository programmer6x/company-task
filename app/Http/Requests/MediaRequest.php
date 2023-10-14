<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ImageType;

class MediaRequest extends FormRequest
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
                'description' => 'max:300|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟ ]+$/u',
                'file' => 'required|file|mimes:png,jpg,jpeg,gif,mp4',
                'type' => [new Enum(ImageType::class),'required'],
                'product_id' => 'required|numeric|exists:products,id',
                'status' => 'required|numeric|in:0,1',
            ];
        }
        else{
            return [
                'name' => 'max:120|min:2|regex:/^[ا-یa-zA-Z0-9\ِِِِِِِِِِِِِِِء-ي., ]+$/u',
                'description' => 'max:300|min:5|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r&?؟ ]+$/u',
                'file' => 'file|mimes:png,jpg,jpeg,gif,mp4',
                'type' => [new Enum(ImageType::class)],
                'product_id' => 'numeric|exists:products,id',
                'status' => 'numeric|in:0,1',
            ];
        }
    }
}
