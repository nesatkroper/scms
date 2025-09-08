<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

abstract class BaseController extends Controller
{
  private string $model;

  public function __construct()
  {
    $this->model = $this->ModelPermissionName();
    // $this->applyPermissions();
  }

  abstract protected function ModelPermissionName(): string;

  protected function applyPermissions(): void
  {
    $model = Str::lower(Str::singular($this->model));

    $this->middleware("permission:view $model")->only(['index', 'show']);
    $this->middleware("permission:create $model")->only(['create', 'store']);
    $this->middleware("permission:update $model")->only(['edit', 'update']);
    $this->middleware("permission:delete $model")->only(['destroy']);
  }
}
