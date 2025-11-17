<?php

use Illuminate\Support\Str;

require __DIR__ . '/vendor/autoload.php';

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
$requestDir = __DIR__ . '/app/Http/Requests';
$viewsDir = __DIR__ . '/resources/views/admin';
$webRoutesFile = __DIR__ . '/routes/web.php';

if (!is_dir($controllerDir))
  mkdir($controllerDir, 0755, true);
if (!is_dir($requestDir))
  mkdir($requestDir, 0755, true);
if (!is_dir($viewsDir))
  mkdir($viewsDir, 0755, true);

// Collect routes to append
$routeContent = "\n// Admin routes generated automatically\nRoute::prefix('admin')->name('admin.')->group(function () {\n";

foreach ($tables as $table) {
  $modelName = Str::studly(Str::singular($table));
  $controllerName = $modelName . 'Controller';
  $storeRequest = 'Store' . $modelName . 'Request';
  $updateRequest = 'Update' . $modelName . 'Request';
  $variablePlural = Str::camel(Str::plural($modelName));
  $variableSingular = Str::camel($modelName);
  $viewFolder = Str::kebab(Str::plural($modelName));

  // ---- Generate FormRequests ----
  foreach ([$storeRequest, $updateRequest] as $requestClass) {
    $requestFile = $requestDir . '/' . $requestClass . '.php';
    if (!file_exists($requestFile)) {
      $requestContent = <<<PHP
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class $requestClass extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Add validation rules here
        ];
    }
}
PHP;
      file_put_contents($requestFile, $requestContent);
      echo "Created FormRequest: $requestClass\n";
    }
  }

  // ---- Generate Admin Controller ----
  $controllerFile = $controllerDir . '/' . $controllerName . '.php';
  $controllerContent = <<<PHP
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
  file_put_contents($controllerFile, $controllerContent);
  echo "Created Admin controller: $controllerName\n";

  // ---- Generate Blade views ----
  $viewFolderPath = $viewsDir . '/' . $viewFolder;
  if (!is_dir($viewFolderPath))
    mkdir($viewFolderPath, 0755, true);

  $views = [
    'index' => <<<HTML
@extends('layouts.admin')
@section('content')
<h1>$modelName List</h1>
<a href="{{ route('admin.$viewFolder.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach (\$$variablePlural as \$$variableSingular)
        <tr>
            <td>{{ \$$variableSingular->id }}</td>
            <td>{{ \$$variableSingular->name ?? \$$variableSingular->title ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.$viewFolder.edit', \$$variableSingular->id) }}">Edit</a>
                <form method="POST" action="{{ route('admin.$viewFolder.destroy', \$$variableSingular->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
HTML
    ,
    'create' => <<<HTML
@extends('layouts.admin')
@section('content')
<h1>Create $modelName</h1>
<form method="POST" action="{{ route('admin.$viewFolder.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection
HTML
    ,
    'edit' => <<<HTML
@extends('layouts.admin')
@section('content')
<h1>Edit $modelName</h1>
<form method="POST" action="{{ route('admin.$viewFolder.update', \$$variableSingular->id) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection
HTML
  ];

  foreach ($views as $viewName => $viewContent) {
    file_put_contents($viewFolderPath . '/' . $viewName . '.blade.php', $viewContent);
  }
  echo "Created Blade views for: $viewFolder\n";

  // ---- Add route ----
  $routeContent .= "    Route::resource('$viewFolder', Admin\\$controllerName::class);\n";
}

$routeContent .= "});\n";

// Append to routes/web.php
file_put_contents($webRoutesFile, $routeContent, FILE_APPEND);
echo "Admin routes appended to routes/web.php\n";
