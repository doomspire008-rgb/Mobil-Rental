@extends('layouts.admin')

@section('title', 'Edit Mobil')

@section('content')
<form method="POST" action="{{ route('admin.cars.update', $car) }}">
    @csrf
    @method('PUT')
    @include('admin.cars._form')
</form>
@endsection
