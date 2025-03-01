<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $id,
        public string $name,
        public string $label,
        public string $type,
        public string $placeholder,
        public string $value = "",
        public string $isRequired = "0",
        public string $isReadOnly = "0",
    ) {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-field');
    }
}
