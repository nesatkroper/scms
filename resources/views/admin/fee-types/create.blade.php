@extends('layouts.admin')
@section('content')
<h1>Create FeeType</h1>
<form method="POST" action="{{ route('admin.fee-types.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection