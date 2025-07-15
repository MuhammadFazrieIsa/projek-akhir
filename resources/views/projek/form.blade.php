<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar RFID</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<<<<<<< HEAD
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>RFID Data Form</h4>
                </div>
                <div class="card-body">
                    <div id="rfidStatus" class="mb-3">
                        @if($rfid_uid)
                            <div class="alert alert-success">
                                RFID Terdeteksi: <strong>{{ $rfid_uid }}</strong>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Silakan tap kartu RFID...
                            </div>
                        @endif
                    </div>

                    <form method="POST" action="{{ route('rfid.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="rfid_uid" class="form-label">RFID UID</label>
                            <input type="text" class="form-control" id="rfid_uid"
                                   name="rfid_uid" value="EE7AC805" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password (butuh setidaknya 6 karakter)</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                       <div class="mb-3">
                          <label for="jabatan" class="form-label">Jabatan</label>
                          <select class="form-control" id="jabatan" name="jabatan" required>
                              <option value="" disabled selected>Pilih Jabatan</option>
                              <option value="admin">Admin</option>
                              <option value="manajer">Manajer</option>
                              <option value="karyawan">Karyawan</option>
                          </select>
                      </div>


                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
=======
<div class="style"> 
    @include('projek.style.lstyle') 
  </div>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

  <div class="card w-75 shadow-lg">
    <div class="row g-0">
      <!-- Form Section -->
      <div class="col-md-6 p-5 bg-white">
        <h2 class="text-center mb-4">Daftarkan Kartu</h2>

        @if(session('status'))
          <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div id="rfidInfo" class="mb-3">
          @if($rfid_uid)
            <div class="alert alert-success text-center">
              RFID Terdeteksi: <strong>{{ $rfid_uid }}</strong>
>>>>>>> 4fb920c (Update folder with latest changes)
            </div>
          @else
            <div class="alert alert-info text-center">
              Silakan tap kartu RFID...
            </div>
          @endif
        </div>

        <form method="POST" action="{{ route('rfid.store') }}">
          @csrf
          <input type="hidden" id="rfid_uid" name="rfid_uid" value="{{ $rfid_uid }}">

          <div class="mb-3">
            <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan Nama" required>
          </div>

          <div class="mb-3">
            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password (min. 6 karakter)" required>
          </div>

          <div class="mb-3">
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
              <option value="" disabled selected>Pilih Jenis Kelamin</option>
              <option value="Laki-Laki">Laki-Laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>

          <div class="mb-3">
            <select name="jabatan" id="jabatan" class="form-select" required>
              <option value="" disabled selected>Pilih Jabatan</option>
              <option value="admin">Admin</option>
              <option value="manajer">Manajer</option>
              <option value="karyawan">Karyawan</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary w-100">Simpan</button>
        </form>

        <div class="text-center mt-3">
          <small class="text-muted">Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></small>
        </div>
      </div>

      <!-- Video Section -->
      <div class="col-md-6 d-flex flex-column justify-content-center align-items-center bg-light p-4">
        <video id="loopVideo" width="100%" autoplay muted playsinline style="object-fit: cover;">
          <source src="https://electropeak.com/learn/wp-content/uploads/2019/04/RC522-RFID-Arduino-Tutorial.mp4" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
<<<<<<< HEAD
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif


    <script>
// Auto-refresh setiap 2 detik
setInterval(function() {
    fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const newRfid = doc.getElementById('rfid_uid').value;
            const currentRfid = document.getElementById('rfid_uid').value;

            if (newRfid && newRfid !== currentRfid) {
                window.location.reload();
            }
        });
}, 2000);

    </script>
=======
  </div>

  <!-- RFID Polling Script -->
  <script>
    function fetchUID() {
      fetch(window.location.href)
        .then(response => response.text())
        .then(html => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          const newRfid = doc.getElementById('rfid_uid').value;
          const currentRfid = document.getElementById('rfid_uid').value;

          if (newRfid && newRfid !== currentRfid) {
            window.location.reload();
          }
        });
    }
    setInterval(fetchUID, 2000);

    const video = document.getElementById('loopVideo');
    video.addEventListener('timeupdate', () => {
      if (video.currentTime >= 2.3) {
        video.currentTime = 0;
        video.play();
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
>>>>>>> 4fb920c (Update folder with latest changes)
</body>
</html>
