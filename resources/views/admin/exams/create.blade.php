@extends('layouts.admin')
@section('content')
<h1>Create Exam</h1>
<form method="POST" action="{{ route('admin.exams.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection