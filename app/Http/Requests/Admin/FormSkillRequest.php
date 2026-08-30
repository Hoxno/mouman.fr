<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class FormSkillRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Libelles utilises dans les messages d'erreur.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'titre',
            'level' => 'niveau',
            'order' => 'ordre',
            'online' => 'publication',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3'],
            'level' => ['nullable', 'integer', 'between:0,100'],
            'order' => ['required', 'integer', 'min:0'],
            'description' => ['min:0'],
            'online' => ['nullable', 'in:0,1'],
        ];
    }
}
