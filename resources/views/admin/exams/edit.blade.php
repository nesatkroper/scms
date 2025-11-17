@extends('layouts.admin')
@section('content')
<h1>Edit Exam</h1>
<form method="POST" action="{{ route('admin.exams.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection