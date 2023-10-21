<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FormWorkRequest extends FormRequest
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
        return [
            'title' => ['required', 'min:3'],
            'company' => ['required', 'min:3'],
            'city' => ['required', 'min:3'],
            'start_date' => ['required'],
            'end_date' => ['min:0'],
            'description' => ['required', 'min:3'],
        ];
    }
}
