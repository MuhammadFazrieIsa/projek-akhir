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


      <!-- Main Content -->
      <div class="content-with-sidebar col-11 bg-light p-2 overflow-auto">

        <div class=" text-black p-5 rounded mb-4">
          <h2 class="mb-2">Selamat Datang, {{ session('user')['name'] }}</h2>
          <p class="text-black-50 mb-0">Admin</p>
        </div>

        <div class="dashboard-cards container-fluid">
          <div class="row g-3">
            <div class="col-md-3">
              <div class="card-box bg-info">
                <div>
                  <h3>11</h3>
                  <p>Items</p>
                </div>
                <i class="fas fa-cart-plus fa-2x"></i>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-box bg-danger">
                <div>
                  <h3>3</h3>
                  <p>Suppliers</p>
                </div>
                <i class="fas fa-truck fa-2x"></i>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-box bg-success">
                <div>
                  <h3>11</h3>
                  <p>Customers</p>
                </div>
                <i class="fas fa-users fa-2x"></i>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card-box bg-warning">
                <div>
                  <h3>4</h3>
                  <p>Users</p>
                </div>
                <i class="fas fa-user-plus fa-2x"></i>
              </div>
            </div>
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
