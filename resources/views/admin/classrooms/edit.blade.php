@extends('layouts.admin')
@section('content')
<h1>Edit Classroom</h1>
<form method="POST" action="{{ route('admin.classrooms.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection