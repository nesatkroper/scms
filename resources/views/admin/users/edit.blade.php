@extends('layouts.admin')
@section('content')
<h1>Edit User</h1>
<form method="POST" action="{{ route('admin.users.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection