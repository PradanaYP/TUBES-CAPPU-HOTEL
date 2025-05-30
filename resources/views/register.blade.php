@extends('layouts.main')

@section('title', 'Register')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
@endpush

@section('content')
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ url('/') }}">
      <img src="{{ asset('Gambar/download (3).jpg') }}" alt="Logo" class="rounded-circle me-2" width="32" height="32" />
      My App
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark fw-semibold active" href="{{ route('register') }}">Register</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- PROFILE DAN FORM REGIS -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6"> 

      <!-- Profile Section -->
      <div class="d-flex align-items-center border-bottom pb-3 mb-4">
        <img
          src="https://cdn-icons-png.flaticon.com/128/17827/17827162.png"
          alt="User"
          class="rounded-circle me-3"
          width="64"
        />
        <div>
          <span class="badge bg-secondary">New User</span>
          <span class="badge bg-light text-dark border">Premium Member</span>
        </div>
      </div>

      <!-- FORM REGISTER -->
      <h2 class="fw-bold">Register</h2>
      <p class="text-muted">Create an account to access exclusive features</p>
      
      <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate>
        @csrf
        
        <!-- Name Field -->
        <div class="mb-3">
          <label class="form-label fw-semibold" for="name">Name</label>
          <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name') }}"
            placeholder="Enter your full name"
            required
            autofocus
            autocomplete="name"
          />
          @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
          @else
            <div class="invalid-feedback">Name is required.</div>
          @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-3">
          <label class="form-label fw-semibold" for="email">Email</label>
          <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email') }}"
            placeholder="Enter your email address"
            required
            autocomplete="username"
          />
          @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
          @else
            <div class="invalid-feedback">Please enter a valid email.</div>
          @enderror
        </div>

        <!-- Password Field -->
        <div class="mb-3">
          <label class="form-label fw-semibold" for="password">Password</label>
          <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            placeholder="Enter your password"
            required
            autocomplete="new-password"
          />
          @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
          @else
            <div class="invalid-feedback">Password is required.</div>
          @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="mb-4">
          <label class="form-label fw-semibold" for="password_confirmation">Confirm Password</label>
          <input
            type="password"
            class="form-control @error('password_confirmation') is-invalid @enderror"
            id="password_confirmation"
            name="password_confirmation"
            placeholder="Confirm your password"
            required
            autocomplete="new-password"
          />
          @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
          @else
            <div class="invalid-feedback">Please confirm your password.</div>
          @enderror
        </div>

        <div class="d-flex flex-column flex-md-row gap-3 align-items-center justify-content-between">
          <button type="submit" class="btn btn-primary">Register</button>
          <a class="text-decoration-none text-muted" href="{{ route('login') }}">
            Already registered? Sign in here
          </a>
        </div>
      </form>
    </div>
  </div>
</div>

<footer class="border-top bg-white py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-center gap-3 text-muted small">
    <a href="#" class="text-decoration-none text-dark">© 2024 My App. All rights reserved.</a>
    <a href="#" class="text-decoration-none text-dark">Privacy Policy</a>
    <a href="#" class="text-decoration-none text-dark">Terms of Service</a>
  </div>
</footer>

@push('scripts')
<script>
// Bootstrap form validation
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
@endpush
@endsection