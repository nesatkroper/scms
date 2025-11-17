@extends('layouts.admin')
@section('content')
<h1>Create TeacherSubject</h1>
<form method="POST" action="{{ route('admin.teacher-subjects.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection