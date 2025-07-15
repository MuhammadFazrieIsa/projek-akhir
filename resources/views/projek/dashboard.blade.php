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

  <div class="style"> 
    @include('projek.style.calendar') 
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
  <hr>

  <ul class="nav flex-column list-unstyled w-100 mt-4">
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

          <div class="style"> 
            @include('projek.style.dstyle') 
          </div>
        <!-- Cards - Vertical Layout -->
        <div class="dashboard-cards container-fluid">
          <div class="card-box bg-info mb-3 d-flex justify-content-between align-items-center">
            <div>
              <h3>11</h3>
              <p>Items</p>
            </div>
            <i class="fas fa-cart-plus fa-2x"></i>
          </div>

          <div class="card-box bg-danger mb-3 d-flex justify-content-between align-items-center">
            <div>
              <h3>3</h3>
              <p>Suppliers</p>
            </div>
            <i class="fas fa-truck fa-2x"></i>
          </div>

          <div class="card-box bg-success mb-3 d-flex justify-content-between align-items-center">
            <div>
              <h3>11</h3>
              <p>Customers</p>
            </div>
            <i class="fas fa-users fa-2x"></i>
          </div>

          <div class="card-box bg-warning mb-3 d-flex justify-content-between align-items-center">
            <div>
              <h3>4</h3>
              <p>Users</p>
            </div>
            <i class="fas fa-user-plus fa-2x"></i>
          </div>

          <!-- Kalender Dinamis -->
          <div class="calendar my-4" id="calendar">
            <div class="month">
              <span id="prev" style="cursor:pointer;">&#10094;</span>
              <span id="monthYear">BULAN TAHUN</span>
              <span id="next" style="cursor:pointer;">&#10095;</span>
            </div>
            <div class="weekdays">
              <div>MON</div><div>TUE</div><div>WED</div><div>THU</div><div>FRI</div><div>SAT</div><div>SUN</div>
            </div>
            <div class="days" id="days"></div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- Real-time Clock -->
  <div class="container"> 
    @include('projek.script.jam') 
  </div>

  <div class="container"> 
    @include('projek.script.sidebar') 
  </div>

  <script>
  const monthYear = document.getElementById('monthYear');
  const daysContainer = document.getElementById('days');
  const prev = document.getElementById('prev');
  const next = document.getElementById('next');

  let date = new Date(); // Ambil waktu saat ini
  const todayDate = new Date(); // Untuk menandai tanggal hari ini

  const renderCalendar = () => {
    const year = date.getFullYear();
    const month = date.getMonth();

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();
    const startDay = firstDay === 0 ? 6 : firstDay - 1;
    const prevLastDate = new Date(year, month, 0).getDate();

    monthYear.innerText = `${date.toLocaleString('default', { month: 'long' }).toUpperCase()} ${year}`;

    let html = '';

    // Tampilkan tanggal bulan sebelumnya (abu-abu)
    for (let i = startDay; i > 0; i--) {
      html += `<div class="text-muted">${prevLastDate - i + 1}</div>`;
    }

    // Tampilkan tanggal bulan sekarang
    for (let i = 1; i <= lastDate; i++) {
      const isToday =
        i === todayDate.getDate() &&
        month === todayDate.getMonth() &&
        year === todayDate.getFullYear();

      html += `<div class="${isToday ? 'today' : ''}">${i}</div>`;
    }

    // Tampilkan tanggal kosong setelah akhir bulan
    const totalCells = startDay + lastDate;
    const nextDays = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
    for (let i = 1; i <= nextDays; i++) {
      html += `<div class="text-muted">${i}</div>`;
    }

    daysContainer.innerHTML = html;
  };

  prev.addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
  });

  next.addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
  });

  renderCalendar();
</script>

</body>
</html>
