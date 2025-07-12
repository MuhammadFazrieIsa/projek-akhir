<!-- Styles -->
<style>
  #calendarPopup {
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
  }
</style>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-info bg-success bg-subtle px-4">
  <div class="container-fluid">
    <a class="navbar-brand d-lg-none">Bank Indonesia</a>

    <div class="ms-auto d-flex align-items-center position-relative">

      <!-- Custom Calendar Trigger -->
      <div class="form-control form-control-sm me-3 bg-light text-dark"
           id="calendarDisplay"
           style="width: 160px; display: inline-block; cursor: pointer;">
        Select date
      </div>

      <!-- Calendar Popup -->
      <div id="calendarPopup"
           class="bg-white border p-2"
           style="display: none; position: absolute; top: 100%; left: auto; z-index: 999;">
        <input type="date" id="nativeCalendar" class="form-control form-control-sm">
      </div>

      <!-- Profile Link -->
      <a href="{{ route('profil.1') }}" class="btn btn-outline-light btn-sm">
        <i class="fa-solid fa-user-circle me-1"></i> {{ session('user')['name'] }}
      </a>
    </div>
  </div>
</nav>