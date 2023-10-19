<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */

     public $type;
    public $class;
    public $name;
    public $value;
    public $label;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $type = 'text', 
        $class = null, 
        $name = '', 
        $value = '', 
        $label = ''
        )
    {
        $this->type = $type;
        $this->class = $class;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label ?: ucfirst($name);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
