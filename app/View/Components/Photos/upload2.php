<?php

namespace App\View\Components\Photos;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class upload2 extends Component
{
    public $class, $name, $icon,  $rounded;

    public function __construct(
        String $name = "",
        String $class = "",
        $rounded = 'rounded-full',
        $icon = 'ri-account-circle-fill',
    ) {
        $this->name = $name;
        $this->class = $class;
        $this->rounded = $rounded;
        $this->icon = $icon;
    }
    public function render(): View|Closure|string
    {
        return view('components.photos.upload2');
    }
}
