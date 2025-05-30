<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Room Selection - MyHotel</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
      <div class="container">
        <img
          src="/images/download (3).jpg"
          alt="Logo"
          class="rounded-circle me-2"
          width="32"
          height="32"
        />
        <a class="navbar-brand fw-semibold" href="#">MyHotel</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">history</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- ROOM SCHEDULE HEADER -->
    <div class="container text-center my-5">
      <h3 class="mb-2 fw-bold">Book a Room: {{ $roomType->type_name }}</h3>
      <p class="text-dark">Only showing available rooms of this type</p>
    </div>
    
    <!-- Room Display -->
    <div class="container mb-5">
      <div class="row g-4">
        <div class="col-12">
          <div class="card">
            <img
              src="{{ asset('/images/kamar A.jpg') }}"
              class="card-img-top img-fluid"
              alt="{{ $roomType->type_name }}"
              style="height: 340px; object-fit: cover"
            />
            <div class="card-body fw-medium">
              <h6 class="fw-medium">{{ $roomType->type_name }}</h6>
              <p class="fw-medium">
                Starting from Rp{{ number_format($roomType->price_per_night, 0, ',', '.') }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- SCHEDULE FORM -->
    <div class="container my-5" data-aos="fade">
      <form
        class="row g-3 bg-body-tertiary p-4 rounded-4 shadow-sm"
        method="POST"
        action="{{ route('room.book') }}"
      >
        @csrf
        <!-- Hidden roomtype_id -->
        <input type="hidden" name="roomtype_id" value="{{ $roomType->id }}">

        <!-- Room Number -->
        <div class="col-lg-4">
          <label for="room_id" class="form-label">Select Room Number</label>
          <select name="room_id" id="room_id" class="form-select" required>
            <option value="">Choose available room...</option>
            @foreach($availableRooms as $room)
              <option value="{{ $room->id }}">{{ $room->room_number }}</option>
            @endforeach
          </select>
        </div>

        <!-- Check-in Date -->
        <div class="col-lg-2">
          <label for="checkin" class="form-label">Check-in</label>
          <input type="date" id="checkin" name="checkin" class="form-control" required onchange="setMinCheckout()">
        </div>

        <!-- Check-out Date -->
        <div class="col-lg-2">
          <label for="checkout" class="form-label">Check-out</label>
          <input type="date" id="checkout" name="checkout" class="form-control" required>
        </div>

        <!-- Guests -->
        <div class="col-lg-2">
          <label for="guests" class="form-label">Guests</label>
          <input type="text" id="guests" name="guests" class="form-control" placeholder="e.g. 2 Adults" required>
        </div>

        <!-- Submit Button -->
        <div class="col-lg-2">
          <label class="form-label invisible">Submit</label>
          <button type="submit" class="btn btn-primary form-control">Book Now</button>
        </div>
      </form>
    </div>

<!--footer-->
 <footer class="footer bg-white text-dark py-4">
  <div class="container d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
    <span class="text-dark">© 2022 MyHotel. All rights reserved.</span>
    <a href="#" class="text-decoration-none text-dark mx-md-3">Terms of Service</a>
    <a href="#" class="text-decoration-none text-dark mx-md-3">Privacy Policy</a>
  </div>
</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function setMinCheckout() {
          const checkin = document.getElementById('checkin').value;
          const checkout = document.getElementById('checkout');
          checkout.min = checkin;
        }
    </script>
  </body>
</html>
