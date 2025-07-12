<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">RFID Data Input</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div id="rfidInfo">
                        <p>Silakan tap kartu RFID Anda...</p>
                    </div>

                    <form id="rfidForm" method="POST" action="{{ route('rfid.store') }}">
                        @csrf
                        <input type="hidden" id="rfid_uid" name="rfid_uid">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nama</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_number" class="col-md-4 col-form-label text-md-right">Nomor ID</label>

                            <div class="col-md-6">
                                <input id="id_number" type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" required>

                                @error('id_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Simpan Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function handleRFIDData(rfidUid) {
    document.getElementById('rfid_uid').value = rfidUid;
    document.getElementById('rfidInfo').innerHTML = 
        `<div class="alert alert-success">Kartu RFID terdeteksi: ${rfidUid}</div>`;

    // Fetch data berdasarkan RFID
    fetch(`/api/get-user-by-rfid/${rfidUid}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('name').value = data.name;
            document.getElementById('id_number').value = data.id_number;
        });
}
</script>
