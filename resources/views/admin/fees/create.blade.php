@extends('layouts.admin')
@section('content')
<h1>Create Fee</h1>
<form method="POST" action="{{ route('admin.fees.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection