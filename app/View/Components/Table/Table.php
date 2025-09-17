<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
  public $headers, $checkbox, $action;

  public function __construct(
    array $headers = [],
    bool $checkbox = true,
    bool $action = true
  ) {
    $this->headers = $headers;
    $this->checkbox = $checkbox;
    $this->action = $action;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.table');
  }
}
