@extends('layouts.admin')
@section('content')
<h1>Create Expense</h1>
<form method="POST" action="{{ route('admin.expenses.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection