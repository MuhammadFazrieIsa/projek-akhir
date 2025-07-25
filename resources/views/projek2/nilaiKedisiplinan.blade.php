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

    <!-- buat csrf  -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

  </head>

  <body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
    <div class="absolute bg-y-50 w-full top-0 bg-[url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg')] min-h-75">
      <span class="absolute top-0 left-0 w-full h-full bg-blue-500 opacity-60"></span>
    </div>
@if(session('user')['jabatan'] == 'Admin')
  <div class="style"> 
    @include('projek2.style.riwayat.sidebar') 
  </div>
@elseif(session('user')['jabatan'] == 'Manajer')
  <div class="style"> 
    @include('projek2.style.riwayat.sidebar2') 
  </div>
@elseif(session('user')['jabatan'] == 'Karyawan')
  <div class="style"> 
    @include('projek2.style.riwayat.sidebar3') 
  </div>
@endif
  
    <main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">

      <div class="style" style="margin-bottom: 50px;"> 
          @include('projek2.style.navbar') 
        </div>
      <!-- end Navbar -->


<div class="bg-white container mx-auto px-4 py-6" style="margin-left: 20px;">
    <h2 class="text-2xl font-semibold text-slate-700 dark:text-white mb-6">
        Rekap Nilai Kedisiplinan Bulan {{ $bulan ?? now()->month }} Tahun {{ $tahun ?? now()->year }}
    </h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Chart Card -->
    <div class="bg-white dark:bg-slate-800 shadow p-4 mb-8">
        <canvas id="fuzzyChart" class="w-full h-64"></canvas>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-slate-800 shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-auto text-center border border-slate-200 dark:border-slate-700">
            <thead class="bg-slate-100 dark:bg-slate-700">
                <tr>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Nama</th>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Lebih Awal</th>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Tepat Waktu</th>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Agak Terlambat</th>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Terlambat</th>
                    <th class="px-4 py-2 text-sm font-semibold text-slate-700 dark:text-white">Jumlah Keseluruhan</th>
                    <th class="px-4 py-2 text-sm font-semibold text-red-500">Kurang Disiplin</th>
                    <th class="px-4 py-2 text-sm font-semibold text-yellow-500">Cukup Disiplin</th>
                    <th class="px-4 py-2 text-sm font-semibold text-green-500">Disiplin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-slate-600">
                @foreach($datas as $data)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700">
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ $data->user->name ?? '-' }}</td>
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ $data->lebih_awal }}</td>
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ $data->tepat_waktu }}</td>
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ $data->agak_terlambat }}</td>
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ $data->terlambat }}</td>
                        <td class="px-4 py-2 text-sm text-slate-600 dark:text-white">{{ number_format($data->jumlah_keseluruhan, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-red-500">{{ number_format($data->nilai_kurang_disiplin, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-yellow-500">{{ number_format($data->nilai_cukup_disiplin, 2) }}</td>
                        <td class="px-4 py-2 text-sm text-green-500">{{ number_format($data->nilai_disiplin, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <a href="{{ route('rekap.absensi') }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Keluar</a>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const jumlah_kehadiran = 24;
    const ctx = document.getElementById('fuzzyChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            datasets: [
                {
                    label: 'Kurang Disiplin',
                    data: [
                        { x: 0, y: 1 },
                        { x: jumlah_kehadiran / 2, y: 1 },
                        { x: jumlah_kehadiran, y: 0 }
                    ],
                    borderColor: 'red',
                    fill: false,
                    spanGaps: true,
                },
                {
                    label: 'Cukup Disiplin',
                    data: [
                        { x: jumlah_kehadiran / 2, y: 0 },
                        { x: jumlah_kehadiran, y: 1 },
                        { x: jumlah_kehadiran + (jumlah_kehadiran / 2), y: 0 }
                    ],
                    borderColor: 'orange',
                    fill: false,
                    spanGaps: true,
                },
                {
                    label: 'Disiplin',
                    data: [
                        { x: jumlah_kehadiran, y: 0 },
                        { x: jumlah_kehadiran + (jumlah_kehadiran / 2), y: 1 },
                        { x: jumlah_kehadiran * 2, y: 1 }
                    ],
                    borderColor: 'green',
                    fill: false,
                    spanGaps: true,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    min: 0,
                    max: jumlah_kehadiran * 2,
                    title: {
                        display: true,
                        text: 'Jumlah Kehadiran'
                    },
                    ticks: {
                        stepSize: jumlah_kehadiran / 2,
                        callback: function (value) {
                            const half = jumlah_kehadiran / 2;
                            if (value === 0) return '0';
                            if (Math.abs(value - half) < 0.01) return `${half}`;
                            if (Math.abs(value - jumlah_kehadiran) < 0.01) return `${jumlah_kehadiran}`;
                            if (Math.abs(value - (jumlah_kehadiran + half)) < 0.01) return `${jumlah_kehadiran + half}`;
                            if (Math.abs(value - (jumlah_kehadiran * 2)) < 0.01) return `${jumlah_kehadiran * 2}`;
                            return '';
                        }
                    }
                },
                y: {
                    min: 0,
                    max: 1.2,
                    title: {
                        display: true,
                        text: 'Derajat Keanggotaan'
                    }
                }
            }
        }
    });
</script>

      
    </main>
    <div fixed-plugin>
      <a fixed-plugin-button class="fixed px-4 py-2 text-xl bg-white shadow-lg cursor-pointer bottom-8 right-8 z-990 rounded-circle text-slate-700">
        <i class="py-2 pointer-events-none fa fa-cog"> </i>
      </a>
      <!-- -right-90 in loc de 0-->
      <div fixed-plugin-card class="z-sticky backdrop-blur-2xl backdrop-saturate-200 dark:bg-slate-850/80 shadow-3xl w-90 ease -right-90 fixed top-0 left-auto flex h-full min-w-0 flex-col break-words rounded-none border-0 bg-white/80 bg-clip-border px-2.5 duration-200">
        <div class="px-6 pt-4 pb-0 mb-0 border-b-0 rounded-t-2xl">
          <div class="float-left">
            <h5 class="mt-4 mb-0 dark:text-white">Argon Configurator</h5>
            <p class="dark:text-white dark:opacity-80">See our dashboard options.</p>
          </div>
          <div class="float-right mt-6">
            <button fixed-plugin-close-button class="inline-block p-0 mb-4 text-sm font-bold leading-normal text-center uppercase align-middle transition-all ease-in bg-transparent border-0 rounded-lg shadow-none cursor-pointer hover:-translate-y-px tracking-tight-rem bg-150 bg-x-25 active:opacity-85 dark:text-white text-slate-700">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="h-px mx-0 my-1 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent" />
        <div class="flex-auto p-6 pt-0 overflow-auto sm:pt-4">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0 dark:text-white">Sidebar Colors</h6>
          </div>
          <a href="javascript:void(0)">
            <div class="my-2 text-left" sidenav-colors>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-500 to-violet-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-slate-700 text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" active-color data-color="blue" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="gray" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-blue-700 to-cyan-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="cyan" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-emerald-500 to-teal-400 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="emerald" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-orange-500 to-yellow-500 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="orange" onclick="sidebarColor(this)"></span>
              <span class="py-2.2 text-xs rounded-circle h-5.6 mr-1.25 w-5.6 ease-in-out bg-gradient-to-tl from-red-600 to-orange-600 relative inline-block cursor-pointer whitespace-nowrap border border-solid border-white text-center align-baseline font-bold uppercase leading-none text-white transition-all duration-200 hover:border-slate-700" data-color="red" onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-4">
            <h6 class="mb-0 dark:text-white">Sidenav Type</h6>
            <p class="text-sm leading-normal dark:text-white dark:opacity-80">Choose between 2 different sidenav types.</p>
          </div>
          <div class="flex">
            <button transparent-style-btn class="inline-block w-full px-4 py-2.5 mb-2 font-bold leading-normal text-center text-white capitalize align-middle transition-all bg-blue-500 border border-transparent border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-500 to-violet-500 hover:border-blue-500" data-class="bg-transparent" active-style>White</button>
            <button white-style-btn class="inline-block w-full px-4 py-2.5 mb-2 ml-2 font-bold leading-normal text-center text-blue-500 capitalize align-middle transition-all bg-transparent border border-blue-500 border-solid rounded-lg cursor-pointer text-sm xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-blue-500 xl-max:to-violet-500 xl-max:text-white xl-max:border-0 hover:-translate-y-px dark:cursor-not-allowed dark:opacity-65 dark:pointer-events-none dark:bg-gradient-to-tl dark:from-blue-500 dark:to-violet-500 dark:text-white dark:border-0 hover:shadow-xs active:opacity-85 ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 bg-none hover:border-blue-500" data-class="bg-white">Dark</button>
          </div>
          <p class="block mt-2 text-sm leading-normal dark:text-white dark:opacity-80 xl:hidden">You can change the sidenav type just on desktop view.</p>
          <!-- Navbar Fixed -->
          <div class="flex my-4">
            <h6 class="mb-0 dark:text-white">Navbar Fixed</h6>
            <div class="block pl-0 ml-auto min-h-6">
              <input navbarFixed class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
            </div>
          </div>
          <hr class="h-px my-6 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent " />
          <div class="flex mt-2 mb-12">
            <h6 class="mb-0 dark:text-white">Light / Dark</h6>
            <div class="block pl-0 ml-auto min-h-6">
              <input dark-toggle class="rounded-10 duration-250 ease-in-out after:rounded-circle after:shadow-2xl after:duration-250 checked:after:translate-x-5.3 h-5 relative float-left mt-1 ml-auto w-10 cursor-pointer appearance-none border border-solid border-gray-200 bg-slate-800/10 bg-none bg-contain bg-left bg-no-repeat align-top transition-all after:absolute after:top-px after:h-4 after:w-4 after:translate-x-px after:bg-white after:content-[''] checked:border-blue-500/95 checked:bg-blue-500/95 checked:bg-none checked:bg-right" type="checkbox" />
            </div>
          </div>
          <a target="_blank" class="dark:border dark:border-solid dark:border-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent border border-solid border-transparent rounded-lg cursor-pointer text-sm ease-in hover:shadow-xs hover:-translate-y-px active:opacity-85 tracking-tight-rem shadow-md bg-150 bg-x-25 bg-gradient-to-tl from-zinc-800 to-zinc-700 dark:bg-gradient-to-tl dark:from-slate-750 dark:to-gray-850" href="https://www.creative-tim.com/product/argon-dashboard-tailwind" >Free Download</a>
          <a target="_blank" class="dark:border dark:border-solid dark:border-white dark:text-white inline-block w-full px-6 py-2.5 mb-4 font-bold leading-normal text-center align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer active:shadow-xs hover:-translate-y-px active:opacity-85 text-sm ease-in tracking-tight-rem bg-150 bg-x-25 border-slate-700 text-slate-700 hover:bg-transparent hover:text-slate-700 hover:shadow-none active:bg-slate-700 active:text-white active:hover:bg-transparent active:hover:text-slate-700 active:hover:shadow-none" href="https://www.creative-tim.com/learning-lab/tailwind/html/quick-start/argon-dashboard/">View documentation</a>
          <div class="w-full text-center">
            <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard-tailwind" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
            <h6 class="mt-4 dark:text-white">Thank you for sharing!</h6>
            <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23tailwindcss&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-twitter"></i> Tweet </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard-tailwind" class="inline-block px-5 py-2.5 mb-0 mr-2 font-bold text-center text-white align-middle transition-all border-0  rounded-lg cursor-pointer hover:shadow-xs hover:-translate-y-px active:opacity-85 leading-normal text-sm ease-in tracking-tight-rem shadow-md bg-150 bg-x-25 me-2 border-slate-700 bg-slate-700" target="_blank"> <i class="mr-1 fab fa-facebook-square"></i> Share </a>
          </div>
        </div>
      </div>
    </div>
  </body>
  <!-- plugin for charts  -->
  <script src="./assets/js/plugins/chartjs.min.js" async></script>
  <!-- plugin for scrollbar  -->
  <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="./assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
</html>
