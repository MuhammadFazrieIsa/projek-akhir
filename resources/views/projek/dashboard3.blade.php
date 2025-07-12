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
<div id="sidebar" class="sidebar sidebar-expanded bg-danger text-white d-flex flex-column align-items-start py-4 px-2">



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
        <i class="fa-solid fa-sack-dollar me-2"></i> <span class="sidebar-text">GAJI SENDIRI</span>
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
          <p class="text-black-50 mb-0">Manajer</p>
        </div>

        <div class="row g-4">
          <!-- Left Panel -->
          <div class="col-md-6">
            <div class="bg-white rounded shadow-sm p-4 h-100">
              <div class="text-center mb-3">
                <div id="piechart" style="width: 100%; height: 200px;"></div>
                <p class="fw-semibold mt-2">ATTENDANCE SPOTS</p>
              </div>

              <ul class="list-unstyled small">
                <li><span class="dot yellow"></span> 5 personnel clocked from this spot</li>
                <li><span class="dot orange"></span> 5 out of spot</li>
                <li><span class="dot gray"></span> 10 clocked-in via admin</li>
                <li><span class="dot green"></span> 6 clocked-in, not yet approved</li>
                <li><span class="dot red"></span> 2 clocked-in at another spot</li>
                <li><span class="dot pink"></span> 29 not clocked yet</li>
              </ul>
            </div>
          </div>

          <!-- Right Panel -->
          <div class="col-md-6">
            <div class="bg-white rounded shadow-sm p-4 mb-4">
              <div id="curve_chart" style="width: 100%; height: 200px;"></div>
              <p class="mt-2">Service active until: <strong>April 30, 2025</strong></p>
              <button class="btn btn-danger mt-2">Add More Spots</button>
            </div>

            <div class="bg-white rounded shadow-sm p-4 mb-4">
              <h5>Your Order</h5>
              <p>No order made.</p>
            </div>

            <div class="bg-white rounded shadow-sm p-4">
              <h5>Account Summary</h5>
              <p>Total users: 76</p>
              <p>Outstanding: Rp 0</p>
            </div>
          </div>
        </div>

        <div class="text-end text-muted small mt-4">© 2025 Indoexpress</div>
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
