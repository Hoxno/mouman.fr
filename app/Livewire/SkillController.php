<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillController extends Component
{

    public $skills;
    public $skill;
    public $confirmSkillDeletion = false;
    public $isCreating = false;
    public $isEditing = false;

    public function render()
    {
        $this->skills = Skill::all();

        return view('livewire.skill-table', [
            'skills'=> $this->skills,
        ]);
    }

    public function create ()
    {
        $this->resetValidation();
        $this->skill = New Skill();
        $this->isCreating = true;
    }

    public function edit (string $id)
    {
        $this->resetValidation();
        $this->skill = Skill::find($id);
        $this->isEditing = true;
    }

    public function save ()
    {
        $this->validate([
            'skill.title' => 'required',
        ]);
    }

    public function confirmSkillDeletion( string $id)
    {
        $this->skill = Skill::find($id);
        $this->confirmSkillDeletion = true;
    }

    public function delete ()
    {
        $this->skill->delete();
        $this->confirmSkillDeletion = false;
        $this->reset();
    }

    public function cancel()
    {
        $this->reset();
    }
}
