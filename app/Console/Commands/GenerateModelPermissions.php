<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Spatie\Permission\Models\Permission;

class GenerateModelPermissions extends Command
{
  protected $signature = 'permissions:generate {--models=all}';
  protected $description = 'Generates permissions for models';

  public function handle()
  {
    $permissions = ['create', 'view', 'update', 'delete'];
    $models = $this->option('models') === 'all'
      ? $this->getModels()
      : explode(',', $this->option('models'));

    foreach ($models as $model) {
      foreach ($permissions as $permission) {
        $permissionName = "{$permission} {$model}";
        Permission::firstOrCreate(['name' => $permissionName]);
        $this->info("Permission created: {$permissionName}");
      }
    }

    $this->info('Permissions generated successfully!');
  }

  protected function getModels()
  {
    $modelPath = app_path('Models');
    $namespace = app()->getNamespace() . 'Models\\';

    return collect(File::files($modelPath))
      ->map(function ($file) use ($namespace) {
        $className = $namespace . pathinfo($file, PATHINFO_FILENAME);

        return new $className;
      })
      ->filter(function ($model) {
        return $model instanceof \Illuminate\Database\Eloquent\Model;
      })
      ->map(function ($model) {
        $className = class_basename($model);
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $className));
      })
      ->values()
      ->toArray();
  }

  // protected function getModels()
  // {
  //   $modelPath = app_path('Models');
  //   $files = File::files($modelPath);

  //   $models = [];

  //   foreach ($files as $file) {
  //     $className = pathinfo($file, PATHINFO_FILENAME);

  //     if ($className === 'Model' || strpos($className, 'Abstract') === 0) {
  //       continue;
  //     }

  //     $modelName = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $className));

  //     $models[] = $modelName;
  //   }

  //   return $models;
  // }
}
