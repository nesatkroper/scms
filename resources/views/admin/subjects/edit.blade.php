@extends('layouts.admin')
@section('content')
<h1>Edit Subject</h1>
<form method="POST" action="{{ route('admin.subjects.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection