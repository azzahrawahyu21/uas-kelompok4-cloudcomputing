@extends('layouts.user')

@section('title', 'Data Statistik - ' . $kategori->nama_kategori)

@section('content')
<div class="header-section text-white d-flex flex-column justify-content-center text-center"
     style="height: 20vh; background: url('{{ asset('assets/img/background.jpg') }}') center/cover no-repeat; position: relative;">
    
    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.45);"></div>

    <h1 class="fw-bold position-relative" style="z-index: 2; font-size:30px;">
        DATA STATISTIK
    </h1>
</div>

<div class="container py-5">
  {{-- 🟢 Kategori Utama --}}
  <h2 class="text-center mb-4 fw-bold" 
      style="color: rgba(13, 71, 21, 1); font-size: 2rem; letter-spacing: 1px;">
    {{ $kategori->nama_kategori }}
  </h2>

  <div class="row g-4">
    @foreach($kategori->subkategoris as $sub)
      <div class="col-md-6">
        <div class="card shadow-sm border-0 statistik-card h-100 p-3">
          {{-- 🟢 Subkategori --}}
          <h4 class="fw-bold mb-3 text-uppercase text-center" 
              style="color: rgba(13, 71, 21, 1); font-size: 1.5rem;">
            {{ $sub->nama_subkategori }}
          </h4>

          <div style="height: 400px;">
            <canvas id="chart{{ $sub->id_subkategori }}" style="width: 100%; height: 100%;"></canvas>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

<style>
.statistik-card {
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: 0 6px 20px rgba(0,0,0,0.25); /* shadow default lebih tebal */
    border-radius: 12px;
    background-color: #fff;
}
.statistik-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.35); /* shadow lebih tebal saat hover */
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const colorPalette = [
  'rgba(220, 20, 60, 0.9)',
  'rgba(0, 123, 255, 0.9)',
  'rgba(255, 193, 7, 0.9)',
  'rgba(40, 167, 69, 0.9)',
  'rgba(255, 87, 34, 0.9)',
  'rgba(156, 39, 176, 0.9)',
  'rgba(0, 188, 212, 0.9)',
  'rgba(233, 30, 99, 0.9)',
];

@foreach($kategori->subkategoris as $sub)
  const ctx{{ $sub->id_subkategori }} = document.getElementById("chart{{ $sub->id_subkategori }}").getContext('2d');
  const labels{{ $sub->id_subkategori }} = {!! json_encode($sub->dataStatistik->pluck('tahun')->map(fn($t)=>date('Y', strtotime($t)))) !!};
  const data{{ $sub->id_subkategori }} = {!! json_encode($sub->dataStatistik->pluck('jumlah')) !!};
  const barColors{{ $sub->id_subkategori }} = data{{ $sub->id_subkategori }}.map((_, i) => colorPalette[i % colorPalette.length]);

  new Chart(ctx{{ $sub->id_subkategori }}, {
    type: 'bar',
    data: {
      labels: labels{{ $sub->id_subkategori }},
      datasets: [{
        data: data{{ $sub->id_subkategori }},
        backgroundColor: barColors{{ $sub->id_subkategori }},
        borderColor: barColors{{ $sub->id_subkategori }}.map(c => c.replace('0.9', '1')),
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          callbacks: {
            title: function(context) { return 'Tahun: ' + context[0].label; },
            label: function(context) { return 'Jumlah: ' + context.formattedValue; }
          }
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Tahun',
            color: 'rgba(13, 71, 21, 1)',
            font: { size: 15, weight: 'bold' }
          },
          ticks: { font: { size: 14 }, color: 'rgba(13, 71, 21, 1)' }
        },
        y: {
          title: {
            display: true,
            text: 'Jumlah',
            color: 'rgba(13, 71, 21, 1)',
            font: { size: 15, weight: 'bold' }
          },
          beginAtZero: true,
          ticks: {
            font: { size: 14 },
            color: 'rgba(13, 71, 21, 1)',
            stepSize: Math.ceil(Math.max(...data{{ $sub->id_subkategori }}) / 5)
          }
        }
      }
    }
  });
@endforeach
</script>
@endsection
