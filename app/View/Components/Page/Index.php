<?php

namespace App\View\Components\Page;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Index extends Component
{
  public $title,
    $iconSvgPath,
    $btnText,
    $btnIconSvgPath,
    $showSearch,
    $showReset,
    $showViewToggle,
    $canCreate;

  public function __construct(
    string $title,
    string $iconSvgPath,
    string $btnText = 'Create New',
    string $btnIconSvgPath = 'M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z',
    bool $showSearch = true,
    bool $showReset = true,
    bool $showViewToggle = true,
    bool $canCreate = true
  ) {
    $this->title = $title;
    $this->iconSvgPath = $iconSvgPath;
    $this->btnText = $btnText;
    $this->btnIconSvgPath = $btnIconSvgPath;
    $this->showSearch = $showSearch;
    $this->showReset = $showReset;
    $this->showViewToggle = $showViewToggle;
    $this->canCreate = $canCreate;
  }


  public function render(): View|Closure|string
  {
    return view('components.page.index');
  }
}
