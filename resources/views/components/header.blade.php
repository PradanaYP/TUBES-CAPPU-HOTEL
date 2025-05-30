<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm custom-navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('images/download (3).jpg') }}" alt="Hotel Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Room Overview</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home Page</a>
        </li>
        
        @guest
          <!-- Menu untuk pengguna yang belum login -->
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" href="{{ route('login') }}">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}" href="{{ route('register') }}">Register</a>
          </li>
        @else
          <!-- Menu untuk pengguna yang sudah login -->
          <li class="nav-item">
            <a class="nav-link {{ request()->is('history') ? 'active' : '' }}" href="{{ route('room.history') }}">History</a>
          </li>
          
          <!-- Dropdown untuk User Account -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="https://cdn-icons-png.flaticon.com/128/17827/17827162.png" alt="User Avatar" width="24" height="24" class="rounded-circle me-1">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="{{ route('user.account') }}">
                  <i class="fas fa-cog me-2"></i>Account Settings
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                  @csrf
                  <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>