@extends('layouts.admin')
@section('content')
<h1>Create Payment</h1>
<form method="POST" action="{{ route('admin.payments.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection