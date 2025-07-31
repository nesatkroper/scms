<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NoData extends Component
{
  public $colspan;

  public function __construct(int $colspan)
  {
    $this->colspan = $colspan;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.no-data');
  }
}
