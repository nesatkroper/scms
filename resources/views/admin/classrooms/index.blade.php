@extends('layouts.admin')
@section('content')
  <h1>Classroom List</h1>
  <a href="{{ route('admin.classrooms.create') }}">Add New</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Room Number</th>
        <th>Capacity</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($classrooms as $classroom)
        <tr>
          <td>{{ $classroom->id }}</td>
          <td>{{ $classroom->name }}</td>
          <td>{{ $classroom->room_number }}</td>
          <td>{{ $classroom->capacity }}</td>
          <td>
            <a href="{{ route('admin.classrooms.edit', $classroom->id) }}">Edit</a>
            <form method="POST" action="{{ route('admin.classrooms.destroy', $classroom->id) }}" style="display:inline">
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
