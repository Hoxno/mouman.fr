<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FormSchoolRequest extends FormRequest
{
    /**
     * Date sentinelle signalant une formation toujours en cours.
     *
     * Les vues publiques la traitent comme l'absence de date de fin,
     * au même titre que null : voir resources/views/home/school.blade.php.
     */
    public const EN_COURS = '1900-01-01';

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
            'school' => ['required', 'min:3'],
            'city' => ['required', 'min:3'],
            'start_date' => ['required', 'date'],
            'end_date' => [
                'nullable',
                'date',
                // La sentinelle "en cours" échappe à la comparaison,
                // sans quoi toute formation non terminée serait rejetée.
                Rule::when(
                    fn (): bool => $this->input('end_date') !== self::EN_COURS,
                    ['after:start_date']
                ),
            ],
            'description' => ['required', 'min:3'],
            'online' => ['nullable', 'in:0,1'],
        ];
    }

    /**
     * Libellés utilisés dans les messages d'erreur.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title' => 'intitulé',
            'school' => 'établissement',
            'city' => 'ville',
            'start_date' => 'date de début',
            'end_date' => 'date de fin',
            'description' => 'description',
        ];
    }
}
