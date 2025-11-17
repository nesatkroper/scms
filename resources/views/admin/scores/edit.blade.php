@extends('layouts.admin')
@section('content')
<h1>Edit Score</h1>
<form method="POST" action="{{ route('admin.scores.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection