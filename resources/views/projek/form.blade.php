<!DOCTYPE html>
<html>
<head>
    <title>RFID Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
            </div>
        </div>
    </div>
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
</body>
</html>
