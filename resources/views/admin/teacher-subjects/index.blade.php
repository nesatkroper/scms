@extends('layouts.admin')
@section('content')
<h1>TeacherSubject List</h1>
<a href="{{ route('admin.teacher-subjects.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teacherSubjects as $teacherSubject)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.teacher-subjects.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.teacher-subjects.destroy', $) }}" style="display:inline">
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