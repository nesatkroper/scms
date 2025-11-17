@extends('layouts.admin')
@section('content')
<h1>Edit Fee</h1>
<form method="POST" action="{{ route('admin.fees.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection