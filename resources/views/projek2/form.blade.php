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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <title>Argon Dashboard 2 Tailwind by Creative Tim</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="../assets/css/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />
  </head>

  <body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">
    <!-- Navbar -->
    <nav class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
      <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
        <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all ease-in-out bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
            <span bar1 class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar2 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar3 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          </span>
        </button>
        <div navbar-menu class="items-center flex-grow transition-all ease duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-2xl lg:flex lg:basis-auto">
          <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg-max:py-2 lg:flex-row xl:ml-auto">

          </ul>
          <!-- online builder btn  -->
          <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-in border-white/75 text-xs tracking-tight-rem rounded-3.5xl hover:border-white/75 hover:-translate-y-px active:hover:border-white/75 active:hover:-translate-y-px active:opacity-85 active:shadow-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="_blank"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
        </div>
      </div>
    </nav>

    <main class="mt-0 transition-all duration-200 ease-in-out">
      <section class="min-h-screen">
        <div class="bg-top relative flex items-start pt-12 pb-56 m-4 overflow-hidden bg-cover min-h-[100vh] rounded-xl">
          <!-- Gradient Overlay -->
          <span class="absolute inset-0 bg-gradient-to-tl from-zinc-800 to-zinc-700 opacity-60"></span>

          <!-- Video fills the parent div absolutely -->
          <video
            class="absolute inset-0 w-full h-full object-cover rounded-xl"
            id="loopVideo"
            autoplay
            muted
            playsinline
            loop
            aria-hidden="true"
          >
            <source src="https://electropeak.com/learn/wp-content/uploads/2019/04/RC522-RFID-Arduino-Tutorial.mp4" type="video/mp4" />
            Your browser does not support the video tag.
          </video>

          <!-- Content on top -->
          <div class="container relative z-10">
            <div class="flex flex-wrap justify-center -mx-3">
              <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                <h1 class="mt-12 mb-2 text-white">Selamat Datang</h1>
                <p class="text-white">Siapkan Kartu RFID untuk Mendaftar.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="flex flex-wrap -mx-3 -mt-48 md:-mt-56 lg:-mt-48">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-7/12 lg:w-5/12 xl:w-4/12">
              <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-xl rounded-2xl bg-clip-border">
                <div class="p-6 mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                
                @if(session('status'))
                  <div class="alert alert-success text-center my-2">{{ session('status') }}</div>
                @endif

                @if($errors->any())
                  <div class="alert alert-danger my-2">
                    <ul class="mb-0">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
                <div class="flex-auto p-6">
                <div id="rfidInfo" class="mb-3">
                  @if($rfid_uid)
                    <div class="bg-green-100 text-green-700 p-2 rounded text-center">
                      RFID Terdeteksi: <strong>{{ $rfid_uid }}</strong>
                    </div>
                  @else
                    <div class="bg-blue-100 text-blue-700 p-2 rounded text-center">
                      Silakan tap kartu RFID...
                    </div>
                  @endif

                </div>
                <div class="flex-auto p-6">
    <form method="POST" action="{{ route('rfid.store') }}">
      @csrf
      <input type="hidden" id="rfid_uid" name="rfid_uid" value="{{ $rfid_uid }}">

      <div class="mb-4">
        <input type="text" name="name" id="name" placeholder="Masukkan Nama"
          class="form-control focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 block w-full rounded-lg border border-solid border-gray-300 bg-white p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300" required>
      </div>

      <div class="mb-4">
        <input type="password" name="password" id="password" placeholder="Masukkan 6 Karakter Password"
          class="form-control focus:shadow-primary-outline dark:bg-gray-950 dark:placeholder:text-white/80 dark:text-white/80 text-sm leading-5.6 block w-full rounded-lg border border-solid border-gray-300 bg-white p-3 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300" required>
      </div>

      <div class="mb-4">
        <select name="jenis_kelamin" id="jenis_kelamin"
          class="form-select block w-full p-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-fuchsia-300" required>
          <option value="" disabled selected>Pilih Jenis Kelamin</option>
          <option value="Laki-Laki">Laki-Laki</option>
          <option value="Perempuan">Perempuan</option>
        </select>
      </div>

      <div class="mb-4">
        <select name="jabatan" id="jabatan"
          class="form-select block w-full p-3 text-sm text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:border-fuchsia-300" required>
          <option value="" disabled selected>Pilih Jabatan</option>
          <option value="Admin">Admin</option>
          <option value="Manajer">Manajer</option>
          <option value="Karyawan">Karyawan</option>
        </select>
      </div>

      <div class="text-center">
        <button type="submit"
          class="inline-block w-full px-6 py-3 mt-4 mb-0 font-bold text-white text-sm leading-normal text-center align-middle transition-all bg-blue-500 border-0 rounded-lg shadow-md cursor-pointer hover:-translate-y-px active:opacity-85 hover:shadow-xs ease-in tracking-tight-rem">
          Simpan
        </button>
      </div>
    </form>

    <div class="text-center mt-4">
      <small class="text-slate-500">Sudah punya akun? <a href="{{ url('/login') }}" class="text-blue-500 font-semibold">Login di sini</a></small>
    </div>
  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
      <footer class="py-12">
        <div class="container">
          <div class="flex flex-wrap -mx-3">
            <div class="flex-shrink-0 w-full max-w-full mx-auto mb-6 text-center lg:flex-0 lg:w-8/12">
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Company </a>
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> About Us </a>
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Team </a>
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Products </a>
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Blog </a>
              <a href="javascript:;" target="_blank" class="mb-2 mr-4 text-slate-400 sm:mb-0 xl:mr-12"> Pricing </a>
            </div>
            <div class="flex-shrink-0 w-full max-w-full mx-auto mt-2 mb-6 text-center lg:flex-0 lg:w-8/12">
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-dribbble"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-twitter"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-instagram"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-pinterest"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-github"></span>
              </a>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3">
            <div class="w-8/12 max-w-full px-3 mx-auto mt-1 text-center flex-0">
              <p class="mb-0 text-slate-400">
                Copyright ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                Argon Dashboard 2 by Creative Tim.
              </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
  </body>
  <!-- plugin for scrollbar  -->
  <script src="../assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <!-- main script file  -->
  <script src="../assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

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
</html>
