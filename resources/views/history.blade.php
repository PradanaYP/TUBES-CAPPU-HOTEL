@extends('layouts.main')

@section('title', 'History')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

@include('components.header')

<div class="container py-4">
  <div class="row g-3">

    @forelse ($reservations as $reservation)
      <div class="col-12">
        <div class="card">
          <div class="card-body d-flex">
            <img
              src="{{ asset('images/kamar A.jpg') }}"
              class="img-fluid rounded-2 me-3"
              style="width: 210px; height: 220px; object-fit: cover"
              alt="Room Image"
            />
            <div>
              <span class="badge bg-secondary mb-2">
                {{ $reservation->rooms->roomTypes->type_name ?? 'Unknown Type' }}
              </span>
              <p class="mb-1 fw-semibold">Room Number: {{ $reservation->rooms->room_number }}</p>
              <p class="mb-0 text-dark small">Check-in: {{ $reservation->check_in }}</p>
              <p class="mb-0 text-dark small">Check-out: {{ $reservation->check_out }}</p>
              <p class="mb-0 text-dark small">Guests: {{ $reservation->guests }}</p>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-info text-center">You have no reservation history yet.</div>
      </div>
    @endforelse

  </div>
</div>

<!-- Profil User -->
<section class="bg-primary text-white py-5" data-aos="fade">
  <div class="container d-flex flex-column flex-md-row align-items-center gap-4">
    <!-- Gambar Profil -->
    @if(Auth::user()->profile_picture)
      <img
        src="{{ Storage::url(Auth::user()->profile_picture) }}"
        alt="User Avatar"
        class="rounded-circle p-1"
        width="100"
        height="100"
        style="object-fit: cover;"
      />
    @else
      <img
        src="{{ asset('images/John doe.png') }}"
        alt="User Avatar"
        class="rounded-circle p-1"
        width="100"
        height="100"
      />
    @endif

    <!-- Informasi User -->
    <div class="text-center text-md-start">
      <h2 class="h5 fw-bold mb-1">{{ Auth::user()->name }}</h2>
      <span class="p-1 mb-3 bg-light text-dark">
        {{ Auth::user()->user_type ?? 'VIP Guest' }}
      </span>
      <p class="mb-0">Thank you for choosing MyHotel.</p>
    </div>
  </div>
</section>


@include('components.footer')

@push('scripts')
<!-- Jika ada JS tambahan bisa ditaruh di sini -->
@endpush

@endsection
