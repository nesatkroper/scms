@extends('layouts.admin')
@section('content')
<h1>Score List</h1>
<a href="{{ route('admin.scores.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($scores as $score)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.scores.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.scores.destroy', $) }}" style="display:inline">
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