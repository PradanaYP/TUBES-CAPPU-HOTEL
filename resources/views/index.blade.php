@extends('layouts.main')

@section('title', 'Cappu Hotel')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400&display=swap" rel="stylesheet">
<style>
  .custom-font {
    font-family: 'Playfair Display', serif;
    font-weight: normal;
    font-size: 24px;
  }
</style>
@endpush

@section('content')
<div class="position-relative vh-100 overflow-hidden">
  <div
    class="position-absolute top-0 start-0 w-100 h-100"
    style="
      background-image: url('{{ asset('Gambar/Desain tanpa judul.png') }}');
      background-size: cover;
      background-position: center;
      filter: brightness(0.7);
    "
  ></div>
  <div
    class="position-relative d-flex flex-column justify-content-center align-items-center h-100 text-white text-center p-3"
  >
    <h1 class="mb-3" style="font-family: 'Playfair Display', serif; font-size: 48px; font-weight: 500;">
      Welcome to Cappu Hotel
    </h1>
    <p class="lead mb-4 fs-4 custom-font">Experience luxury at its best</p>
    <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-2">Go Booking</a>
  </div>
</div>
@endsection
