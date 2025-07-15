<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Login</title>
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <div class="style"> 
    @include('projek.style.lstyle') 
  </div>
</head>
<body class="d-flex justify-content-center align-items-center">

  <div class="card w-75">
    <div class="row g-0">
      <!-- Left: Form Section -->
      <div class="col-md-6 p-5">
        <h2 class="text-center mb-4">Masukan Akun</h2>

        @if ($errors->any())
          <div class="error mb-3">
            {{ $errors->first() }}
          </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
          @csrf
          <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="Masukan Nama" required />
          </div>
          <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Masukan Password" required />
          </div>
          <div class="mb-3">
            <a href="#" class="text-muted small">Lupa password?</a>
          </div>
          <button type="submit" class="btn btn-login w-100 py-2 mb-3">Login</button>
        </form>

        <div class="text-center">
          <small class="text-muted">Belum punya akun? <a href="{{ url('/rfid/form') }}">Daftar sekarang</a></small>
        </div>
      </div>

      <!-- Right: Welcome Section -->
      <div class="col-md-6 bg-login-right d-flex flex-column justify-content-center align-items-center text-center p-4">
        <h1 class="display-5">Halo, Selamat Datang!</h1>
        <p class="lead">Daftar/Log in untuk melanjutkan</p>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle (Optional, if needed) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
