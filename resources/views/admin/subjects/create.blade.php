@extends('layouts.admin')
@section('content')
<h1>Create Subject</h1>
<form method="POST" action="{{ route('admin.subjects.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection