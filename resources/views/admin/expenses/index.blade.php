@extends('layouts.admin')
@section('content')
<h1>Expense List</h1>
<a href="{{ route('admin.expenses.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenses as $expense)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.expenses.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.expenses.destroy', $) }}" style="display:inline">
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