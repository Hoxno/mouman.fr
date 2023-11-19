<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillForm extends Component
{
    public Skill $skill;

    protected $rules = [
        'skill.title' => 'required|string|min:3',
        'skill.description' => 'required|string'
    ];
    public function mount()
    {
        $this->skill = new Skill(); // Initialisation du modèle Skill
    }
    public function deleteSkill(int $id)
    {
        Skill::destroy($id);
    }

    public function save()
    {
        $this->validate();

        $this->skill->save(); // Sauvegarde des données de compétence

        $this->emit('skillUpdated');

        session()->flash('success', 'Compétence enregistrée avec succès!');

        return redirect()->route('dashboard.skill.index'); // Redirection après sauvegarde
    }

    public function render()
    {
        return view('livewire.skill-form');
    }
}