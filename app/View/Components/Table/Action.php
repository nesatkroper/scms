<?php

namespace App\View\Components\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Action extends Component
{
  public $userId;

  public function __construct($userId)
  {
    $this->userId = $userId;
  }

  public function render(): View|Closure|string
  {
    return view('components.table.action');
  }
}
