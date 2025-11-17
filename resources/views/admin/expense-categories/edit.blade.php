@extends('layouts.admin')
@section('content')
<h1>Edit ExpenseCategory</h1>
<form method="POST" action="{{ route('admin.expense-categories.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection