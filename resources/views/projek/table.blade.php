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


      <!-- Table -->
    <div class="table-responsive content-with-sidebar">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>ID</th>
                    <th>Icon</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Jenis Kelamin</th>
                    <th>UID</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td class="text-center">
                  @php
                      $iconUrl = $user->jenis_kelamin === 'Laki-Laki'
                          ? 'https://cdn-icons-png.flaticon.com/512/4140/4140048.png'
                          : 'https://cdn-icons-png.flaticon.com/512/4140/4140051.png';
                  @endphp
                  <img src="{{ $iconUrl }}" width="48" height="48" alt="Icon {{ $user->jenis_kelamin }}" class="rounded-circle">
                </td>

                <td>{{ $user->name }}</td>
                <td>{{ $user->jabatan }}</td>
                <td>{{ $user->jenis_kelamin }}</td>
                <td>{{ $user->rfid_uid }}</td>

                {{-- Status --}}
                <td>
                    @php
                        $hadir = optional($user->absenTerbaru)->kedatangan !== null;
                    @endphp
                    <span class="badge {{ $hadir ? 'bg-success' : 'bg-secondary' }}">
                        {{ $hadir ? 'Hadir' : 'Tidak Hadir' }}
                    </span>
                </td>

                {{-- Aksi --}}
                <td>
                    <form action="{{ route('karyawan.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">Data tidak ditemukan.</td>
            </tr>
            @endforelse
            </tbody>

        </table>
    </div>

    <!-- Footer -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <span class="content-with-sidebar badge bg-info text-dark">Info! Total Karyawan: {{ $users->total() }}</span>
        <div class="content-with-sidebar d-flex align-items-center gap-3">
            <span>Halaman: {{ $users->currentPage() }}</span>
            <nav>
                {{ $users->withQueryString()->links() }}
            </nav>
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
