<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Component;

class Input extends Component
{
    public string $name;
    public string $label;
    public string $type;
    public ?string $value;
    
    public function __construct(string $name, string $label, string $type, ?string $value = null)
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

    public function render() :View
    {
        return view('components.input');
    }
}