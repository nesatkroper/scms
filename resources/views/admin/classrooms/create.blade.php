@extends('layouts.admin')
@section('content')
<h1>Create Classroom</h1>
<form method="POST" action="{{ route('admin.classrooms.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection