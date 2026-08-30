<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FormSchoolRequest;
use App\Models\School;
use Illuminate\Http\RedirectResponse;

class SchoolController extends ResourceController
{
    protected function model(): string
    {
        return School::class;
    }

    protected function prefix(): string
    {
        return 'dashboard.school';
    }

    /**
     * @return array{0: string, 1: string}
     */
    protected function variables(): array
    {
        return ['school', 'schools'];
    }

    /**
     * @return array{created: string, updated: string, deleted: string}
     */
    protected function messages(): array
    {
        return [
            'created' => 'La formation ajoutée avec succès !',
            'updated' => 'La formation mise à jour avec succès !',
            'deleted' => 'La formation supprimée avec succès !',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSchoolRequest $request): RedirectResponse
    {
        return $this->enregistrer($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSchoolRequest $request, string $id): RedirectResponse
    {
        return $this->enregistrer($request->validated(), $id);
    }
}
