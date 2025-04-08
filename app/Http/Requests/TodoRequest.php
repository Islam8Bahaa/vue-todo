<?php

namespace App\Http\Requests;

use App\Enums\PriorityEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class TodoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required','string','max:191'],
            'description' => ['required','string','max:191'],
            'priority' => ['required','numeric', new Enum(PriorityEnum::class)],
            'status' => ['nullable','numeric','in:0,1']
        ];
    }
}
