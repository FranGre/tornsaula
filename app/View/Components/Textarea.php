<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public $name;
    public $placeholder;
    public $slot;

    /**
     * Create a new component instance.
     */
    public function __construct($name, $placeholder = null, $slot = null)
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->slot = $slot;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea');
    }
}
