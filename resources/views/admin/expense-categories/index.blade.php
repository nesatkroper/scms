@extends('layouts.admin')
@section('content')
<h1>ExpenseCategory List</h1>
<a href="{{ route('admin.expense-categories.create') }}">Add New</a>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name / Title</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($expenseCategories as $expenseCategory)
        <tr>
            <td>{{ $ }}</td>
            <td>{{ $ ?? $ ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.expense-categories.edit', $) }}">Edit</a>
                <form method="POST" action="{{ route('admin.expense-categories.destroy', $) }}" style="display:inline">
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