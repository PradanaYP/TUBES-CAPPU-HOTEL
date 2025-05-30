<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Room Overview Wireframe</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- AOS CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css"
      rel="stylesheet"
    />
    <link href="styles.css" rel="stylesheet" />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white shadow-sm custom-navbar"
    >
      <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <img
            src="/images/download (3).jpg"
            alt="Hotel Logo"
            width="40"
            height="40"
            class="me-2 rounded-circle"
          />
          <span class="fw-semibold">Room Overview</span>
        </a>
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
            <li class="nav-item">
              <a class="nav-link active" href="#">Home Page</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Booking History</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="container my-5" data-aos="fade">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h1 class="fw-bold">{{ $roomType->type_name }}</h1>
          <p>{{ $roomType->description }}</p>
        </div>
        <div class="col-md-6">
          @if($roomType->hasOverviewImage())
            <img
              src="{{ asset('storage/' . $roomType->overview_image) }}"
              width="520px"
              height="400px"
              class="img-fluid"
              alt="{{ $roomType->type_name }}"
            />
          @endif
        </div>
      </div>
    </div>

    <!-- Virtual Tour Gallery -->
    <div class="container my-5">
      <div class="d-flex justify-content-center mt-4">
        <a
          href="{{ route('room.selection', ['roomTypeId' => $roomType->id]) }}"
          class="btn btn-primary rounded-1 px-4 py-2 d-flex align-items-center shadow-sm"
        >
          <i class="fas fa-paper-plane me-2"></i>
          Make a Schedule
        </a>
      </div>
    </div>
      <h5 class="text-center mb-4" data-aos="fade">
        High-Quality Images & Virtual Tour
      </h5>

      <div class="d-flex flex-wrap justify-content-center gap-4">
        @foreach ($roomType->getGalleryImages() as $index => $image)
          <div class="card" style="width: 18rem" data-aos="fade" data-aos-anchor-placement="center-bottom">
            <img src="{{ asset('storage/' . $image) }}" class="card-img-top" alt="Gallery Image {{ $index + 1 }}">
            <div class="card-body text-center">
              <h5 class="card-title">Gallery Image {{ $index + 1 }}</h5>
              <p class="card-text">Room detail preview</p>
              <p>😃😊</p>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- Amenities -->
    <div class="container mt-5">
      <div class="row align-items-center">
        <div class="col-md-6">
          <h2 class="mb-4">Amenities & Features</h2>
          <div class="row g-4">
            <!-- Free Wi-Fi -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-duration="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">📶</span>
                <!-- Ukuran besar -->
              </div>
              <h6 class="fw-bold mt-2 mb-1">Free Wi-Fi</h6>
              <p class="small text-muted">High-speed internet</p>
            </div>

            <!-- Air conditioning -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">❄️</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Air Conditioning</h6>
              <p class="small text-muted">Temperature control</p>
            </div>

            <!-- TV -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">📺</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Flat-screen TV</h6>
              <p class="small text-muted">Entertainment</p>
            </div>

            <!-- Minibar -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">🧊</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Minibar</h6>
              <p class="small text-muted">Refreshments</p>
            </div>

            <!-- Bathroom -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">🚿</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Private Bathroom</h6>
              <p class="small text-muted">Toiletries provided</p>
            </div>

            <!-- Coffee -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">☕</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Coffee/Tea Maker</h6>
              <p class="small text-muted">Beverage options</p>
            </div>

            <!-- Work Desk -->
            <div
              class="col-6 text-center"
              data-aos="fade-up"
              data-aos-delay="900"
            >
              <div
                class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center"
                style="width: 100px; height: 100px"
              >
                <span class="fs-1">💼</span>
              </div>
              <h6 class="fw-bold mt-2 mb-1">Work Desk</h6>
              <p class="small text-muted">Convenient workspace</p>
            </div>
          </div>
        </div>

        <!-- Right Column: Image -->
        <div class="col-md-6" data-aos="fade-up" data-aos-duration="3000">
          <img
            src="/images/Breakfeast.jpg"
            alt="Breakfast and amenities"
            style="width: 60%; height: 520px; object-fit: cover"
          />
        </div>
      </div>
    </div>

    <!-- Guest Reviews -->
    <div class="container my-5" data-aos="fade">
      <div class="row mb-4 align-items-center">
        <div class="col-md-1 d-flex justify-content-center">
          <!-- SVG icon -->
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="100"
            height="100"
            viewBox="0 0 24 24"
            fill="#2563EB"
          >
            <path
              d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"
            />
          </svg>
        </div>
        <div class="col-md-11">
          <h2 class="fw-bold mb-1">Guest Reviews & Ratings</h2>
          <p class="mb-0">Real customer feedback</p>
        </div>
      </div>
    </div>
    <div class="container my-5" data-aos="fade-up">
      <div class="row g-4 justify-content-center">
        <!-- Review Card 1 -->
        <div class="col-md-4">
          <div class="card p-3 bg-light h-100">
            <div class="d-flex align-items-center mb-2">
              <img
                src="/images/John doe.jpg"
                width="40"
                height="40"
                class="rounded-circle me-2"
                alt="John"
              />
              <strong>John</strong>
              <div class="ms-auto text-warning">★★★★★</div>
            </div>
            <p class="mb-2">Excellent room with great amenities</p>
            <div>✨ 👏</div>
          </div>
        </div>

        <!-- Review 2 -->
        <div class="col-md-4">
          <div class="card p-3 bg-light h-100">
            <div class="d-flex align-items-center mb-2">
              <img
                src="/images/Alicde Jhoson.jpg"
                width="40"
                height="40"
                class="rounded-circle me-2"
                alt="Sarah"
              />
              <strong>Sarah</strong>
              <div class="ms-auto text-warning">★★★★★</div>
            </div>
            <p class="mb-2">Beautiful city view from the room</p>
            <div>✨ 👏</div>
          </div>
        </div>

        <!-- Review 3 -->
        <div class="col-md-4">
          <div class="card p-3 bg-light h-100">
            <div class="d-flex align-items-center mb-2">
              <img
                src="/images/Jane Smith.jpg"
                width="40"
                height="40"
                class="rounded-circle me-2"
                alt="Mike"
              />
              <strong>Mike</strong>
              <div class="ms-auto text-warning">★★★★★</div>
            </div>
            <p class="mb-2">Comfortable stay for business trip</p>
            <div>✨ 👏</div>
          </div>
        </div>
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

    <!-- Footer -->
    <footer class="bg-light py-4 mt-4">
      <div class="container text-center">
        <p class="mb-0">© 2021 Room Overview. All rights reserved.</p>
      </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
          // Global settings
          duration: 900,
          easing: "ease-in-out",
          once: false,
          mirror: false,
          startEvent: "DOMContentLoaded",
          disable: "mobile",
        });
      });
    </script>
  </body>
</html>
