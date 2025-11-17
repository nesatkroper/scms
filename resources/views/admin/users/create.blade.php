@extends('layouts.admin')
@section('content')
<h1>Create User</h1>
<form method="POST" action="{{ route('admin.users.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection