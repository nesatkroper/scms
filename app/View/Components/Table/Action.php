<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
  public $id;

  public function __construct($id)
  {
    $this->id = $id;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.action');
  }
}
