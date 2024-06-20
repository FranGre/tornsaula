<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Questions extends Component
{

    public $questions;

    /**
     * Create a new component instance.
     */
    public function __construct($questions)
    {
        $this->questions = $questions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.questions');
    }
}
