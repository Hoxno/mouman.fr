<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FormSkillRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('dashboard.skill.index', [
            'skills' => Skill::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('dashboard.skill.form', [
            'skill' => new Skill()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormSkillRequest $request): RedirectResponse
    {
        $skill = Skill::create($request->validated());
        return redirect()->route('dashboard.skill.index')->with('success', 'Compétence ajoutée avec succès !');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $skill = Skill::findOrFail($id);
        return view('dashboard.skill.form', compact('skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormSkillRequest $request, Skill $skill): RedirectResponse
    {
        $skill->update($request->validated());
        return redirect()->route('dashboard.skill.index')->with('success', 'Compétence mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();
        return redirect()->route('dashboard.skill.index')->with('success', 'Compétence supprimée avec succès !');
    }
}