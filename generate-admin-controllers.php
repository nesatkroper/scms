<?php

use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';

// List of tables / models
$tables = [
  'classrooms',
  'departments',
  'users',
  'subjects',
  'expense_categories',
  'expenses',
  'attendances',
  'exams',
  'fee_types',
  'fees',
  'payments',
  'scores',
  'teacher_subject',
  'schedules',
];

$controllerDir = __DIR__ . '/app/Http/Controllers/Admin';

if (!is_dir($controllerDir)) {
  mkdir($controllerDir, 0755, true);
}

foreach ($tables as $table) {
  $modelName = Str::studly(Str::singular($table));
  $controllerName = $modelName . 'Controller';
  $storeRequest = 'Store' . $modelName . 'Request';
  $updateRequest = 'Update' . $modelName . 'Request';
  $filePath = $controllerDir . '/' . $controllerName . '.php';

  // Plural camelCase for variables
  $variablePlural = Str::camel(Str::plural($modelName));
  $variableSingular = Str::camel($modelName);

  $viewFolder = Str::kebab(Str::plural($modelName)); // e.g., expense-categories

  $content = <<<PHP
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\\$modelName;
use App\Http\Requests\\$storeRequest;
use App\Http\Requests\\$updateRequest;

class $controllerName extends Controller
{
    public function index()
    {
        \$$variablePlural = $modelName::all();
        return view('admin.$viewFolder.index', compact('$variablePlural'));
    }

    public function create()
    {
        return view('admin.$viewFolder.create');
    }

    public function store($storeRequest \$request)
    {
        $modelName::create(\$request->validated());
        return redirect()->route('admin.$viewFolder.index')->with('success', '$modelName created successfully');
    }

    public function edit(\$id)
    {
        \$$variableSingular = $modelName::findOrFail(\$id);
        return view('admin.$viewFolder.edit', compact('$variableSingular'));
    }

    public function update($updateRequest \$request, \$id)
    {
        \$$variableSingular = $modelName::findOrFail(\$id);
        \$$variableSingular->update(\$request->validated());
        return redirect()->route('admin.$viewFolder.index')->with('success', '$modelName updated successfully');
    }

    public function destroy(\$id)
    {
        \$$variableSingular = $modelName::findOrFail(\$id);
        \$$variableSingular->delete();
        return redirect()->route('admin.$viewFolder.index')->with('success', '$modelName deleted successfully');
    }
}
PHP;

  file_put_contents($filePath, $content);
  echo "Created Admin controller: $controllerName\n";
}
