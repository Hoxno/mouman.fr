<?php

namespace App\Livewire;

use App\Models\Skill;
use Livewire\Component;

class SkillTable extends Component
{
    public int $editId = 0;
    public array $selected = [];

    protected $listeners = [
        'skillUpdated' => 'onSkillUpdated',
    ];
    public function deleteSkill(int $id)
    {
        Skill::destroy($id);
    }

    public function startEdit(int $id)
    {
        $this->editId = $id;
    }

    public function onSkillUpdated()
    {
        $this->reset('editId');
    }
    public function render()
    {
        $this->skills = Skill::all();

        return view('livewire.skill-table', [
            'skills'=> $this->skills,
        ]);
    }
}
