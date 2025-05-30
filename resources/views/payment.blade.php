@extends('layouts.main')

@section('title', 'Payment')

@section('content')
<div class="container py-5">
  <!-- Guest Info -->
  <div class="text-center mb-4">
    <h4 class="fw-bold">Booking Summary</h4>
    <p>Room: {{ $reservation->rooms->room_number }} - {{ $reservation->rooms->roomTypes->type_name }}</p>
    <p>Guests: {{ $reservation->guests }}</p>
    <p>Price per night: {{ $reservation->rooms->roomTypes->price_per_night }}</p>
    <p>Check-in: {{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }} |
       Check-out: {{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</p>
    @php
        $nights = max(1, \Carbon\Carbon::parse($reservation->check_out)->diffInDays(\Carbon\Carbon::parse($reservation->check_in), false));
        $pricePerNight = $reservation->rooms->roomTypes->price_per_night * $reservation->guests;
        $total = $nights * $pricePerNight;
    @endphp
  </div>

  <!-- Total Cost -->
  <div class="row mb-4 justify-content-center">
    <div class="col-md-6">
      <label class="form-label">Total Payment</label>
      <input type="text" class="form-control bg-body-tertiary" value="Rp{{ number_format($total, 0, ',', '.') }}" readonly>
    </div>
  </div>

  <!-- Payment Form -->
  <form id="paymentForm" method="POST" action="{{ route('payment.store', ['res_id' => $reservation->res_id]) }}">
    @csrf
    <input type="hidden" name="amount" value="{{ $total }}">

    <div class="row justify-content-center mb-4">
      <div class="col-md-6">
        <label for="payment_method" class="form-label">Payment Method</label>
        <select class="form-select" name="payment_method" id="payment_method" required>
          <option value="">Choose method...</option>
          <option value="cash">Cash</option>
          <option value="credit_card">Credit Card</option>
          <option value="debit_card">Debit Card</option>
          <option value="qris">QRIS</option>
        </select>
      </div>
    </div>

    <div class="d-grid col-md-4 mx-auto mb-5">
      <button type="submit" class="btn btn-primary">Confirm Payment</button>
    </div>
  </form>

  <!-- Optional: Confirmation Message -->
  @if(session('success'))
  <div class="alert alert-success text-center">
    {{ session('success') }}
  </div>
  @endif
</div>

<!-- Footer -->
<footer class="text-dark py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
    <span>© 2025 MyHotel. All rights reserved.</span>
    <a href="#" class="text-decoration-none text-dark mx-md-3">Terms of Service</a>
    <a href="#" class="text-decoration-none text-dark mx-md-3">Privacy Policy</a>
  </div>
</footer>
@endsection
