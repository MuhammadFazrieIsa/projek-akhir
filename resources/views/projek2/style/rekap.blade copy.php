@extends('layouts.app')

@section('title', 'Beranda')

@section('isi')



<div class="flex flex-wrap justify-center gap-6 p-6 bg-gray-100 dark:bg-slate-900">
<!-- resources/views/rekap.blade.php -->

<div class="flex flex-wrap justify-center gap-6 p-6 bg-gray-100 dark:bg-slate-900">

  <!-- Form Rekap Kehadiran -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kehadiran</h3>
    <input list="bulan-list" name="bulan" id="bulanKehadiran"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Bulan">
    <input list="tahun-list" name="tahun" id="tahunKehadiran"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Tahun">

    <button type="button" id="openRekapKehadiran"
      class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
      <i class="fas fa-landmark"></i>
      Rekap Kehadiran
    </button>
  </div>

  <!-- Form Rekap Kedisiplinan -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kedisiplinan</h3>
    <input list="bulan-list" name="bulan"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Bulan">
    <input list="tahun-list" name="tahun"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Tahun">

    <button type="button" id="openRekapDisiplin"
      class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
      <i class="fas fa-landmark"></i>
      Rekap Kedisiplinan
    </button>
  </div>

  <!-- Form Rekap Kinerja -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kinerja</h3>
    <input list="bulan-list" name="bulan"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Bulan">
    <input list="tahun-list" name="tahun"
      class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
      placeholder="Pilih atau ketik Tahun">

    <button type="button" id="openRekapKinerja"
      class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
      <i class="fas fa-landmark"></i>
      Rekap Kinerja
    </button>
  </div>

  <!-- Datalist Bulan & Tahun -->
  <datalist id="bulan-list">
    <option value="01">Januari</option>
    <option value="02">Februari</option>
    <option value="03">Maret</option>
    <option value="04">April</option>
    <option value="05">Mei</option>
    <option value="06">Juni</option>
    <option value="07">Juli</option>
    <option value="08">Agustus</option>
    <option value="09">September</option>
    <option value="10">Oktober</option>
    <option value="11">November</option>
    <option value="12">Desember</option>
  </datalist>

  <datalist id="tahun-list">
    @for ($i = 2022; $i <= date('Y'); $i++)
      <option value="{{ $i }}">{{ $i }}</option>
    @endfor
  </datalist>
</div>

<!-- Modal -->
<div id="rekapModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white rounded-xl shadow-lg w-[95%] max-w-5xl p-6 relative overflow-y-auto max-h-[90vh]">
    <button id="closeModal" class="absolute top-2 right-3 text-2xl text-gray-600 hover:text-red-500">&times;</button>
    <div id="modalContent"></div>
  </div>
</div>

<!-- Hidden Contents for Modal -->
<div id="rekapKehadiranContent" class="hidden">
  <h4 class="text-lg font-semibold">Rekap Keseluruhan Bulan {{ $bulan }} Tahun {{ $tahun }}</h4>
  <canvas id="kehadiranChart" width="450" height="250"></canvas>
  <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center mt-4">
    <thead>
      <tr>
        <th>Nama</th><th>Email</th><th>Hadir</th><th>Izin</th><th>Alpa</th>
        <th>Jumlah Kehadiran</th><th>Kurang Baik</th><th>Cukup Baik</th><th>Baik</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kinerjaDatas as $data)
        <tr>
          <td>{{ $data->user->name }}</td>
          <td>{{ $data->user->email }}</td>
          <td>{{ $data->hadir }}</td>
          <td>{{ $data->izin }}</td>
          <td>{{ $data->alpa }}</td>
          <td>{{ number_format($data->jumlah_kehadiran, 2) }}</td>
          <td>{{ number_format($data->nilai_kurang_baik, 2) }}</td>
          <td>{{ number_format($data->nilai_cukup_baik, 2) }}</td>
          <td>{{ number_format($data->nilai_baik, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div id="rekapDisiplinContent" class="hidden">
  <h4 class="text-lg font-semibold">Rekap Disiplin Bulan {{ $bulan ?? now()->month }} Tahun {{ $tahun ?? now()->year }}</h4>
  <canvas id="disiplinChart" width="450" height="250"></canvas>
  <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center mt-4">
    <thead>
      <tr>
        <th>Nama</th><th>Lebih Awal</th><th>Tepat Waktu</th><th>Agak Terlambat</th><th>Terlambat</th>
        <th>Jumlah</th><th>Kurang</th><th>Cukup</th><th>Disiplin</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kedisiplinanDatas as $data)
        <tr>
          <td>{{ $data->user->name ?? '-' }}</td>
          <td>{{ $data->lebih_awal }}</td>
          <td>{{ $data->tepat_waktu }}</td>
          <td>{{ $data->agak_terlambat }}</td>
          <td>{{ $data->terlambat }}</td>
          <td>{{ number_format($data->jumlah_keseluruhan, 2) }}</td>
          <td>{{ number_format($data->nilai_kurang_disiplin, 2) }}</td>
          <td>{{ number_format($data->nilai_cukup_disiplin, 2) }}</td>
          <td>{{ number_format($data->nilai_disiplin, 2) }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div id="rekapKinerjaContent" class="hidden">
  <h4 class="text-lg font-semibold">Hasil Rekap Nilai Kinerja Semua Karyawan</h4>
  <canvas id="kinerjaChart" width="450" height="250"></canvas>
  <table border="1" cellpadding="10" cellspacing="0" class="w-full text-center mt-4">
    <thead>
      <tr>
        <th>Nama</th><th>R1</th><th>R2</th><th>R3</th><th>R4</th>
        <th>R5</th><th>R6</th><th>R7</th><th>R8</th><th>Defuzzifikasi</th><th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach($kinerjaDatas as $data)
        <tr>
          <td>{{ $data->user->name ?? '-' }}</td>
          <td>{{ number_format($data->rule_1 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_2 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_3 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_4 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_5 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_6 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_7 ?? 0, 4) }}</td>
          <td>{{ number_format($data->rule_8 ?? 0, 4) }}</td>
          <td>{{ number_format($data->nilai_defuzzifikasi ?? 0, 4) }}</td>
          <td>{{ $data->status }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  $(document).ready(function () {
    // Utility: replace placeholders in modal content
    function fillPlaceholders(template, bulan, tahun) {
      return template
        .replaceAll('{{ $bulan }}', bulan || '-')
        .replaceAll('{{ $tahun }}', tahun || '-')
        .replaceAll('{{ $bulan ?? now()->month }}', bulan || '-')
        .replaceAll('{{ $tahun ?? now()->year }}', tahun || '-');
    }

    // Rekap Kehadiran
    $('#openRekapKehadiran').click(function () {
      const bulan = $('#bulanKehadiran').val();
      const tahun = $('#tahunKehadiran').val();

      let content = $('#rekapKehadiranContent').html();
      content = fillPlaceholders(content, bulan, tahun);

      $('#modalContent').html(content);
      $('#rekapModal').removeClass('hidden');
    });

    // Rekap Kedisiplinan
    $('#openRekapDisiplin').click(function () {
      const bulan = $('input[name="bulan"]').eq(1).val(); // second bulan input
      const tahun = $('input[name="tahun"]').eq(1).val(); // second tahun input

      let content = $('#rekapDisiplinContent').html();
      content = fillPlaceholders(content, bulan, tahun);

      $('#modalContent').html(content);
      $('#rekapModal').removeClass('hidden');
    });

    // Rekap Kinerja
    $('#openRekapKinerja').click(function () {
      const bulan = $('input[name="bulan"]').eq(2).val(); // third bulan input
      const tahun = $('input[name="tahun"]').eq(2).val(); // third tahun input

      let content = $('#rekapKinerjaContent').html();
      content = fillPlaceholders(content, bulan, tahun);

      $('#modalContent').html(content);
      $('#rekapModal').removeClass('hidden');
    });

    // Close modal on close button
    $(document).on('click', '#closeModal', function () {
      $('#rekapModal').addClass('hidden');
    });

    // Close modal on clicking outside content
    $('#rekapModal').on('click', function (e) {
      if ($(e.target).is('#rekapModal')) {
        $('#rekapModal').addClass('hidden');
      }
    });
  });
</script>



        <div class="style"> 
          @include('projek2.style.rekapisi') 
        </div>

</div>

@endsection

