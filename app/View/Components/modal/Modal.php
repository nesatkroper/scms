<?php

namespace App\View\Components\Modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $id, $spacing, $class, $title, $svgPath, $fill, $viewBox, $svgClass, $stroke;

    public function __construct(
        $id,
        String $title = "",
        String $spacing = "p-4",
        $svgPath = "",
        String $class = "",
        $fill = 'currentColor',
        $viewBox = '0 0 20 20',
        $svgClass = 'rounded-full',
        $stroke = null,

    ) {
        $this->title = $title;
        $this->spacing = $spacing;
        $this->svgPath = $svgPath;
        $this->fill = $fill;
        $this->viewBox = $viewBox;
        $this->svgClass = $svgClass;
        $this->stroke = $stroke;
        $this->class = $class;
        $this->id = $id;
    }
    public function render(): View|Closure|string
    {
        return view('components.modal.modal');
    }
}
