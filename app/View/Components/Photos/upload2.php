<?php

namespace App\View\Components\Photos;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class upload2 extends Component
{
  public $class;
  public $name;
  public $icon;
  public $rounded;

  public function __construct(
    string $name = "",
    string $class = "",
    string $icon = 'ri-account-circle-fill',
    string $rounded = 'rounded-full'
  ) {
    $this->name = $name;
    $this->class = $class;
    $this->icon = $icon;
    $this->rounded = $rounded;
  }

  public function render(): View|Closure|string
  {
    return view('components.photos.upload2');
  }
}
