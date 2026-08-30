<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\FormSkillRequest;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;

class SkillController extends ResourceController
{
    protected function model(): string
    {
        return Skill::class;
    }

    protected function prefix(): string
    {
        return 'dashboard.skill';
    }

    /**
     * @return array{0: string, 1: string}
     */
    protected function variables(): array
    {
        return ['skill', 'skills'];
    }

    /**
     * @return array{created: string, updated: string, deleted: string}
     */
    protected function messages(): array
    {
        return [
            'created' => 'Compétence ajoutée avec succès !',
            'updated' => 'Compétence mise à jour avec succès !',
            'deleted' => 'Compétence supprimée avec succès !',
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSkillRequest $request): RedirectResponse
    {
        return $this->enregistrer($request->validated());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSkillRequest $request, string $id): RedirectResponse
    {
        return $this->enregistrer($request->validated(), $id);
    }
}
