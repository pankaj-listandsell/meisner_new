<?php

namespace Modules\Form\Components;

use Illuminate\View\Component;

class PaintingFormComponent extends Component
{

    public $honeypot;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(\Spatie\Honeypot\Honeypot $honeypot)
    {
        $this->honeypot = $honeypot->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('Form::components.painting_form');
    }
}
