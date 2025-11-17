@extends('layouts.admin')
@section('content')
<h1>Schedule List</h1>
<a href="{{ route('admin.schedules.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($schedules as $schedule)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.schedules.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.schedules.destroy', $) }}" style="display:inline">
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