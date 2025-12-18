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
        $permissionName = "{$permission}_{$model}";
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

    $models = collect(File::files($modelPath))
      ->map(function ($file) use ($namespace) {
        $className = $namespace . pathinfo($file, PATHINFO_FILENAME);
        return $className;
      })
      ->filter(function ($className) {
        return class_exists($className) && is_subclass_of($className, \Illuminate\Database\Eloquent\Model::class);
      })
      ->map(function ($className) {
        $className = class_basename($className);
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $className));
      })
      ->values()
      ->toArray();

    $models[] = 'role';
    $models[] = 'permission';
    $models[] = 'teacher';
    $models[] = 'student';

    return $models;
  }
}
