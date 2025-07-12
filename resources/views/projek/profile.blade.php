<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Aplikasi Absensi Online</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://www.gstatic.com/charts/loader.js"></script>

  <div class="style"> 
    @include('projek.style.sidebar') 
  </div>

</head>

<body class="vh-100 d-flex flex-column">

 <div class="style"> 
    @include('projek.style.navbar') 
  </div>

  <div class="container-fluid h-100">
    <div class="row h-100">

      <!-- Sidebar -->
<div id="sidebar" class="sidebar sidebar-expanded bg-primary text-white d-flex flex-column align-items-start py-4 px-2">



  <div class="fs-2 my-4 sidebar-clock" id="clock">00:00:00</div>

  <ul class="list-unstyled w-100 mt-4">
    <li class="sidebar-item">
      <a href="{{ route('dashboard.admin') }}" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fa-solid fa-table-columns me-2"></i> <span class="sidebar-text">BERANDA</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a href="#" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fa-solid fa-clock-rotate-left me-2"></i> <span class="sidebar-text">RIWAYAT PRESENSI</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a href="#" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fa-solid fa-sack-dollar me-2"></i> <span class="sidebar-text">KALKULASI GAJI</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a href="{{ route('karyawan.index') }}" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fa-solid fa-table-columns me-2"></i> <span class="sidebar-text">DAFTAR KARYAWAN</span>
      </a>
    </li>

    <li class="sidebar-item">
      <a href="{{ route('logout') }}" class="text-white text-decoration-none d-flex align-items-center">
        <i class="fa-solid fa-right-from-bracket me-2"></i> <span class="sidebar-text">LOG OUT</span>
      </a>
    </li>
  </ul>
    <!-- Toggle Button -->
  <button id="toggleSidebar" class="btn btn-sm btn-light mb-4 align-self-end">
    <i class="fa-solid fa-bars"></i>
  </button>
</div>


     <div class="container content-with-sidebar">
    <div class="row justify-content-center">
      <!-- Profile Picture -->
      <div class="col-md-4 mb-4">
        <div class="card text-center">
          <div class="card-body">
            <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Profile Picture">
            <p class="text-muted">JPG or PNG no larger than 5 MB</p>
            <input type="file" class="form-control">
            <button class="btn btn-primary mt-3">Upload new image</button>
          </div>
        </div>
      </div>

      <!-- Account Details -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Account Details</h5>
          </div>
          <div class="card-body">
            <form>
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="{{ session('user')['name'] }}">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">First name</label>
                  <input type="text" class="form-control" value="#">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Last name</label>
                  <input type="text" class="form-control" value="#">
                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Organization name</label>
                  <input type="text" class="form-control" value="Bank Indonesia">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Location</label>
                  <input type="text" class="form-control" value="Jakarta, DKI Jakarta">
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" value="name@example.com">
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="form-label">Phone number</label>
                  <input type="text" class="form-control" value="555-123-4567">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="form-label">Birthday</label>
                  <input type="date" class="form-control" value="1986-06-10">
                </div>
              </div>

              <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Real-time Clock -->
  <div class="container"> 
    @include('projek.script.jam') 
  </div>

  <!-- Charts -->
  <div class="container"> 
    @include('projek.script.linechart') 
  </div>

  <div class="container"> 
    @include('projek.script.piechart') 
  </div>

  <div class="container"> 
    @include('projek.script.kalender') 
  </div>

  <div class="container"> 
    @include('projek.script.sidebar') 
  </div>


</body>
</html>
