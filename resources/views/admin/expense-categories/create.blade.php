@extends('layouts.admin')
@section('content')
<h1>Create ExpenseCategory</h1>
<form method="POST" action="{{ route('admin.expense-categories.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection