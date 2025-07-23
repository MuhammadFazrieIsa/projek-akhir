{{-- Load Chart.js once --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  function renderKehadiranChart() {
    const ctx = document.getElementById('kehadiranChart');
    if (!ctx) return;
    new Chart(ctx.getContext('2d'), {
      type: 'line',
      data: {
        labels: [0, 6, 12, 18, 24, 30],
        datasets: [
          {
            label: 'Kurang Baik',
            data: [1, 1, 0, null, null, null],
            borderColor: 'red',
            fill: false,
            spanGaps: true,
          },
          {
            label: 'Cukup Baik',
            data: [null, 0, 1, 0, null, null],
            borderColor: 'orange',
            fill: false,
            spanGaps: true,
          },
          {
            label: 'Baik',
            data: [null, null, 0, 1, 1, null],
            borderColor: 'green',
            fill: false,
            spanGaps: true,
          }
        ]
      },
      options: {
        responsive: false,
        scales: {
          x: { title: { display: true, text: 'Nilai' } },
          y: {
            min: 0,
            max: 1.2,
            title: { display: true, text: 'Derajat Keanggotaan' }
          }
        }
      }
    });
  }

  function renderDisiplinChart() {
    const jumlah_kehadiran = 24;
    const ctx = document.getElementById('disiplinChart');
    if (!ctx) return;
    new Chart(ctx.getContext('2d'), {
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
            fill: false
          },
          {
            label: 'Cukup Disiplin',
            data: [
              { x: jumlah_kehadiran / 2, y: 0 },
              { x: jumlah_kehadiran, y: 1 },
              { x: jumlah_kehadiran * 1.5, y: 0 }
            ],
            borderColor: 'orange',
            fill: false
          },
          {
            label: 'Disiplin',
            data: [
              { x: jumlah_kehadiran, y: 0 },
              { x: jumlah_kehadiran * 1.5, y: 1 },
              { x: jumlah_kehadiran * 2, y: 1 }
            ],
            borderColor: 'green',
            fill: false
          }
        ]
      },
      options: {
        responsive: false,
        scales: {
          x: {
            type: 'linear',
            min: 0,
            max: jumlah_kehadiran * 2,
            title: { display: true, text: 'Jumlah Kehadiran' }
          },
          y: {
            min: 0,
            max: 1.2,
            title: { display: true, text: 'Derajat Keanggotaan' }
          }
        }
      }
    });
  }

  function renderKinerjaChart() {
    const ctx = document.getElementById('kinerjaChart');
    if (!ctx) return;
    new Chart(ctx.getContext('2d'), {
      type: 'line',
      data: {
        labels: [0, 60, 75, 90, 100],
        datasets: [
          {
            label: 'Kurang Baik',
            data: [1, 1, 0, null, null],
            borderColor: 'red',
            fill: false
          },
          {
            label: 'Cukup Baik',
            data: [null, 0, 1, 0, null],
            borderColor: 'orange',
            fill: false
          },
          {
            label: 'Baik',
            data: [null, null, 0, 1, 1],
            borderColor: 'green',
            fill: false
          }
        ]
      },
      options: {
        responsive: false,
        scales: {
          x: { title: { display: true, text: 'Nilai' } },
          y: {
            min: 0,
            max: 1.2,
            title: { display: true, text: 'Derajat Keanggotaan' }
          }
        }
      }
    });
  }
</script>
