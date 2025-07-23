<!--

=========================================================
* Argon Dashboard 2 Tailwind - v1.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard-tailwind
* Copyright 2022 Creative Tim (https://www.creative-tim.com)

* Coded by www.creative-tim.com

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <!-- Main Styling -->
    <link href="./assets/css/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />
  </head>

  <!-- plugin for charts  -->
  <script src="./assets/js/plugins/chartjs.min.js" async></script>
  <!-- plugin for scrollbar  -->
  <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="./assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>


<div class="container mx-auto px-4 py-6">
    <h4 class="text-xl font-bold mb-4">Rekap Kehadiran Bulan {{ $bulan }} Tahun {{ $tahun }}</h4>

    <div class="flex justify-center mb-6">
        <canvas id="fuzzyChart" class="w-full max-w-xl h-64"></canvas>
    </div>

    <div class="overflow-x-auto mb-10">
        <table class="w-full text-sm border border-gray-300 rounded-md shadow-md">
            <thead class="bg-gray-100">
                <tr class="text-left text-gray-700">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Hadir</th>
                    <th class="px-4 py-2 border">Izin</th>
                    <th class="px-4 py-2 border">Alpa</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Kurang</th>
                    <th class="px-4 py-2 border">Cukup</th>
                    <th class="px-4 py-2 border">Baik</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach($datas as $data)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $data->user->name }}</td>
                        <td class="px-4 py-2 border text-center">{{ $data->hadir }}</td>
                        <td class="px-4 py-2 border text-center">{{ $data->izin }}</td>
                        <td class="px-4 py-2 border text-center">{{ $data->alpa }}</td>
                        <td class="px-4 py-2 border text-center">{{ number_format($data->jumlah_kehadiran, 2) }}</td>
                        <td class="px-4 py-2 border text-center text-red-600">{{ number_format($data->nilai_kurang_baik, 2) }}</td>
                        <td class="px-4 py-2 border text-center text-yellow-600">{{ number_format($data->nilai_cukup_baik, 2) }}</td>
                        <td class="px-4 py-2 border text-center text-green-600">{{ number_format($data->nilai_baik, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tabel harian -->
    <div class="overflow-x-auto mt-10">
        <h5 class="text-lg font-semibold mb-2">Detail Kehadiran Harian</h5>
        <table class="min-w-full text-sm text-left border border-gray-300 shadow-sm">
            <thead class="bg-slate-100 text-slate-800">
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Nama</th>
                    @for ($i = 1; $i <= 31; $i++)
                        <th class="px-2 py-1 border text-center">{{ $i }}</th>
                    @endfor
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($pegawais as $index => $pegawai)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border font-medium">{{ $pegawai['nama'] }}</td>
                        @foreach ($pegawai['rekap'] as $status)
                            <td class="px-2 py-1 text-center border
                                @if ($status == 'Hadir') bg-green-100 text-green-700
                                @elseif ($status == 'Izin') bg-yellow-100 text-yellow-700
                                @elseif ($status == 'Alpa') bg-red-100 text-red-700
                                @else text-gray-400
                                @endif">
                                {{ $status }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('fuzzyChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: [0, 6, 12, 18, 24, 30],
            datasets: [
                {
                    label: 'Kurang Baik',
                    data: [1, 1, 0, null, null, null],
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.3,
                    fill: false,
                    spanGaps: true,
                },
                {
                    label: 'Cukup Baik',
                    data: [null, 0, 1, 0, null, null],
                    borderColor: 'rgb(234, 179, 8)',
                    backgroundColor: 'rgba(234, 179, 8, 0.1)',
                    tension: 0.3,
                    fill: false,
                    spanGaps: true,
                },
                {
                    label: 'Baik',
                    data: [null, null, 0, 1, 1, null],
                    borderColor: 'rgb(34, 197, 94)',
                    backgroundColor: 'rgba(34, 197, 94, 0.1)',
                    tension: 0.3,
                    fill: false,
                    spanGaps: true,
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: { display: true, text: 'Jumlah Kehadiran' }
                },
                y: {
                    title: { display: true, text: 'Derajat Keanggotaan' },
                    min: 0,
                    max: 1.2
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: '#333'
                    }
                }
            }
        }
    });
</script>

