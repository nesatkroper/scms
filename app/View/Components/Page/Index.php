<?php

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
  public $title;
  public $iconSvgPath;
  public $createButtonText;
  public $createButtonIconSvgPath;

  public function __construct(
    string $title,
    string $iconSvgPath,
    string $createButtonText = 'Create New',
    string $createButtonIconSvgPath = 'M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z'
  ) {
    $this->title = $title;
    $this->iconSvgPath = $iconSvgPath;
    $this->createButtonText = $createButtonText;
    $this->createButtonIconSvgPath = $createButtonIconSvgPath;
  }

  public function render(): View|Closure|string
  {
    return view('components.page.index');
  }
}
