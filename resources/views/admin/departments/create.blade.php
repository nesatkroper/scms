@extends('layouts.admin')
@section('content')
<h1>Create Department</h1>
<form method="POST" action="{{ route('admin.departments.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection