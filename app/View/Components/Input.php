<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $label;
    public $type;
    public $value;
    
    public function __construct($name, $label, $type, $value = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
    }

    public function isImage(): bool
    {
        return str_starts_with(Storage::mimeType($this->value), 'image/');
    }

    public function isPdf(): bool
    {
        return str_starts_with(Storage::mimeType($this->value), 'application/pdf');
    }

    public function render()
    {
        return view('components.input');
    }
}