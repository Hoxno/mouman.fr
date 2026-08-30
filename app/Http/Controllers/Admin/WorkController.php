<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FormWorkRequest;
use App\Models\Work;
use Illuminate\Http\RedirectResponse;

class WorkController extends ResourceController
{
    protected function model(): string
    {
        return Work::class;
    }

    protected function prefix(): string
    {
        return 'dashboard.work';
    }

    /**
     * @return array{0: string, 1: string}
     */
    protected function variables(): array
    {
        return ['work', 'works'];
    }

    /**
     * @return array{created: string, updated: string, deleted: string}
     */
    protected function messages(): array
    {
        return [
            'created' => 'L\'expérience ajoutée avec succès !',
            'updated' => 'L\'expérience mise à jour avec succès !',
            'deleted' => 'L\'expérience supprimée avec succès !',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormWorkRequest $request): RedirectResponse
    {
        return $this->enregistrer($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormWorkRequest $request, string $id): RedirectResponse
    {
        return $this->enregistrer($request->validated(), $id);
    }
}
