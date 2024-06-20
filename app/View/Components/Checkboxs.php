<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkboxs extends Component
{
    public $options;
    public $name;
    public $modulesSelected;

    /**
     * Create a new component instance.
     */
    public function __construct($options, $name, $modulesSelected)
    {
        $this->options = $options;
        $this->name = $name;
        $this->modulesSelected = $modulesSelected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkboxs');
    }
}
