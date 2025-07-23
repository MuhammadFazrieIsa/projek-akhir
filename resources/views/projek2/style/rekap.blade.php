<div class="flex flex-wrap justify-center gap-6 p-6 bg-gray-100 dark:bg-slate-900">

  <!-- Form Rekap Kehadiran -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <form action="{{ route('kehadiran') }}" method="POST">
      @csrf
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kehadiran</h3>

      <!-- Input Bulan -->
      <input list="bulan-list" name="bulan"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Bulan">
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

      <!-- Input Tahun -->
      <input list="tahun-list" name="tahun"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Tahun">
      <datalist id="tahun-list">
        @for ($i = 2022; $i <= date('Y'); $i++)
          <option value="{{ $i }}">{{ $i }}</option>
        @endfor
      </datalist>

      <!-- Tombol Submit -->
      <button type="submit"
        class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
        <i class="fas fa-landmark"></i>
        Rekap Kehadiran
      </button>
    </form>
  </div>

  <!-- Form Rekap Kedisiplinan -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <form action="{{ route('kedisiplinan') }}" method="POST">
      @csrf
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kedisiplinan</h3>

      <input list="bulan-list" name="bulan"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Bulan">

      <input list="tahun-list" name="tahun"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Tahun">

      <button type="submit"
        class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
        <i class="fas fa-landmark"></i>
        Rekap Kedisiplinan
      </button>
    </form>
  </div>

  <!-- Form Rekap Kinerja -->
  <div class="w-full max-w-sm bg-white rounded-2xl shadow-lg p-6 text-center">
    <form action="{{ route('rekap.kinerja') }}" method="POST">
      @csrf
      <h3 class="text-xl font-semibold text-gray-800 mb-4">Rekap Kinerja</h3>

      <input list="bulan-list" name="bulan"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Bulan">

      <input list="tahun-list" name="tahun"
        class="w-full mb-4 px-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
        placeholder="Pilih atau ketik Tahun">

      <button type="submit"
        class="w-full mt-2 inline-flex items-center justify-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm font-medium rounded-lg shadow hover:shadow-lg hover:opacity-90 transition duration-200">
        <i class="fas fa-landmark"></i>
        Rekap Kinerja
      </button>
    </form>
  </div>

</div>
