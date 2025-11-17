@extends('layouts.admin')
@section('content')
<h1>Edit FeeType</h1>
<form method="POST" action="{{ route('admin.fee-types.update', $) }}">
    @csrf
    @method('PUT')
    <!-- Add your form fields here -->
    <button type="submit">Update</button>
</form>
@endsection