<div class="left 100 p-4 bg-white rounded-lg shadow-md mt-8 ml-90">
  <h2 class="text-xl font-semibold mb-4">Rekap Presensi</h2>

  <!-- Filter Form -->
  <form class="flex flex-wrap items-center gap-4 mb-6" method="GET">

    <div>
      <label class="block text-sm font-medium text-slate-700">Periode</label>
      <div class="flex gap-2">
        <select class="block border rounded px-3 py-2" name="bulan">
          @for ($i = 1; $i <= 12; $i++)
            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}" {{ $bulan == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
              {{ DateTime::createFromFormat('!m', $i)->format('F') }}
            </option>
          @endfor
        </select>
        <select class="block border rounded px-3 py-2" name="tahun">
          @for ($y = 2023; $y <= date('Y'); $y++)
            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
          @endfor
        </select>

                <a style="margin-left: 50px;" class="text-sm mb-4 text-gray-600" href="{{ route('rekap.presensi.pdf', ['bulan' => $bulan, 'tahun' => $tahun, 'pegawai' => request('pegawai', 'semua')]) }}"
          class=" mt-6 px-4 py-2 bg-red-600 text-white rounded shadow hover:bg-red-700">
          Download PDF
        </a>
      </div>
    </div>

    <button type="submit" class="mt-6 px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">
      Submit
    </button>
  </form>

  <!-- Keterangan -->
  <p class="text-sm mb-4 text-gray-600">
    Keterangan: <span class="font-bold">V</span> = Tepat Waktu, 
    <span class="font-bold">TL</span> = Terlambat Masuk, 
    <span class="font-bold">PSW</span> = Pulang Sebelum Waktunya, 
    <span class="font-bold">TAM</span> = Tidak Absen Masuk, 
    <span class="font-bold">TAP</span> = Tidak Absen Pulang
  </p>

  <!-- Tabel -->
  <div class="overflow-x-auto">
    <table class="min-w-full text-sm text-left border border-gray-300">
      <thead class="bg-gray-100 text-slate-700">
  <tr>
    @if(session('user')['jabatan'] != 'karyawan')
      <th class="px-4 py-2 border">No</th>
    @endif
    <th class="px-4 py-2 border">Nama</th>
    @for ($i = 1; $i <= 31; $i++)
      <th class="px-2 py-1 border text-center">{{ $i }}</th>
    @endfor
  </tr>
</thead>

<tbody>
  @foreach ($presensiData as $index => $pegawai)
    @if(
      session('user')['jabatan'] != 'karyawan' || 
      session('user')['name'] == $pegawai['nama']
    )
      <tr class="hover:bg-gray-50">
        @if(session('user')['jabatan'] != 'karyawan')
          <td class="px-4 py-2 border">{{ $index + 1 }}</td>
        @endif

        {{-- Show name based on role --}}
        <td class="px-4 py-2 border">
          @if(session('user')['jabatan'] == 'karyawan')
            {{ session('user')['name'] }}
          @else
            {{ $pegawai['nama'] }}
          @endif
        </td>

        {{-- Rekap --}}
        @foreach ($pegawai['rekap'] as $status)
          <td class="px-2 py-1 text-center border 
            @if ($status == 'V') bg-green-100 text-green-700
            @elseif (in_array($status, ['TL', 'PSW', 'TAM', 'TAP'])) bg-red-100 text-red-600
            @endif">
            {{ $status }}
          </td>
        @endforeach
      </tr>
    @endif
  @endforeach
</tbody>



    </table>
  </div>
</div>


