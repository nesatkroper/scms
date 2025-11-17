@extends('layouts.admin')
@section('content')
<h1>Create Attendance</h1>
<form method="POST" action="{{ route('admin.attendances.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection