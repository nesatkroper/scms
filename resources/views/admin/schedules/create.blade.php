@extends('layouts.admin')
@section('content')
<h1>Create Schedule</h1>
<form method="POST" action="{{ route('admin.schedules.store') }}">
    @csrf
    <!-- Add your form fields here -->
    <button type="submit">Save</button>
</form>
@endsection