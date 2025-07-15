<!-- Styles -->
<style>
  #calendarPopup {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
  }

</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-info bg-info px-4">
  <div class="container-fluid">

    <div class="ms-auto d-flex align-items-center position-relative">

      <!-- Profile Link -->
      <a href="{{ route('profil.1') }}" class="btn btn-outline-light btn-sm">
        <i class="fa-solid fa-user-circle me-1"></i> {{ session('user')['name'] }}
      </a>
    </div>
  </div>
</nav>