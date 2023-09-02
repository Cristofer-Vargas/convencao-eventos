<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class createShowEvento extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
			public string $method,
			public string $submitText,
			public $evento = []
		)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.create-show-evento');
    }
}
