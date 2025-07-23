<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Presensi</title>
    <style>
        body { font-family: sans-serif; font-size: 8px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
</style>

    </style>
</head>

<body>
    <h2>Rekap Presensi - {{ DateTime::createFromFormat('!m', $bulan)->format('F') }} {{ $tahun }}</h2>
    <p><strong>Keterangan:</strong> V = Tepat Waktu, TL = Terlambat Masuk, PSW = Pulang Sebelum Waktunya, TAM = Tidak Absen Masuk, TAP = Tidak Absen Pulang</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                @for ($i = 1; $i <= 31; $i++)
                    <th>{{ $i }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach ($presensiData as $index => $pegawai)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left;">{{ $pegawai['nama'] }}</td>
                    @for ($i = 0; $i < 31; $i++)
                        @php
                            $status = $pegawai['rekap'][$i] ?? '-';
                            $bgColor = '';
                            if ($status == 'V') {
                                $bgColor = '#d4edda'; // green
                            } elseif (in_array($status, ['TL', 'PSW', 'TAM', 'TAP'])) {
                                $bgColor = '#f8d7da'; // red
                            }
                        @endphp
                        <td style="background-color: {{ $bgColor }}">{{ $status }}</td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
