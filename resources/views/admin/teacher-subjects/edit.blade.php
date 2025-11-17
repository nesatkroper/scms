@extends('layouts.admin')
@section('content')
<h1>Edit TeacherSubject</h1>
<form method="POST" action="{{ route('admin.teacher-subjects.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection