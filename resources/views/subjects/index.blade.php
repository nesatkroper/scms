@extends('layouts.app') {{-- Assuming you have a layout --}}

@section('content')
  <div class="container">
    <h1>Subjects</h1>

    @if (session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <a href="{{ route('subjects.create') }}" class="btn btn-primary mb-3">Add New Subject</a>

    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Code</th>
          <th>Department</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($subjects as $subject)
          <tr>
            <td>{{ $subject->id }}</td>
            <td>{{ $subject->name }}</td>
            <td>{{ $subject->code }}</td>
            <td>{{ $subject->department->name ?? 'N/A' }}</td> {{-- Display department name --}}
            <td>
              <a href="{{ route('subjects.show', $subject) }}" class="btn btn-info btn-sm">View</a>
              <a href="{{ route('subjects.edit', $subject) }}" class="btn btn-warning btn-sm">Edit</a>
              <form action="{{ route('subjects.destroy', $subject) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm"
                  onclick="return confirm('Are you sure you want to delete this subject?')">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    {{ $subjects->links() }} {{-- For pagination links --}}
  </div>
@endsection
