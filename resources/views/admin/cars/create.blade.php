@extends('layouts.admin')

@section('title', 'Tambah Mobil')

@section('content')
<form method="POST" action="{{ route('admin.cars.store') }}">
    @csrf
    @include('admin.cars._form')
</form>
@endsection
