@extends('layouts.admin')
@section('content')
<h1>Classroom List</h1>
<a href="{{ route('admin.classrooms.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($classrooms as $classroom)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.classrooms.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.classrooms.destroy', $) }}" style="display:inline">
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