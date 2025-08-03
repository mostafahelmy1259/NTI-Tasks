<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <!-- App brand/logo -->
    <a class="navbar-brand" href="#">Articles App</a>
    
    <!-- Mobile menu toggle button -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <!-- Navigation menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        @auth
          <!-- Show these links only for logged-in users -->
          <li class="nav-item"><a class="nav-link" href="">My Articles</a></li>
          <li class="nav-item">
            <!-- Logout form - must be POST with CSRF protection -->
            <form method="POST" action="{{ route ('logout') }}">
              @csrf
              <button class="btn btn-link nav-link">Logout</button>
            </form>
          </li>
        @else
          <!-- Show these links only for guests (not logged in) -->
          <li class="nav-item"><a class="nav-link" href="{{ route ('login') }}">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route ('register') }}">Register</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>