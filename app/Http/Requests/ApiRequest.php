<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class ApiRequest extends FormRequest
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
    abstract public function rules(): array;

    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator,response()->json([
            'success' => false,
            'error' => 'validation error',
            'errors' => $validator->errors()
        ])))
            ->errorBag($this->errorBag);
    }
}
