@extends('layouts.admin')
@section('content')
<h1>Edit Expense</h1>
<form method="POST" action="{{ route('admin.expenses.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection