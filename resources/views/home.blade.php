@extends('layout.layout')
@section('container')


<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Dashboard</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col">
                <canvas id="myChart" width="50"></canvas>
            </div>
            <div class="col">
                <h3 class="text-center lead">Kendaraan yang tersedia</h3>
                <div class="card">
                    @if ($kendaraan_tersedia->count() > 0)
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Plat No</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kendaraan_tersedia as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->plat_no }}</td>
                                <td><span class="badge badge-primary">{{ $data->status_kendaraan->status_kendaraan }}</span></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    {{ $total_kendaraan_tersedia > 0 ? 'Masih tersisa ' . $total_kendaraan_tersedia . ' kendaraan lainnya yang tersedia - ' : '' }}
                                     check <a href="/pesan-kendaraan">di sini</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <div class="my-5">
                        <div class="text-center">
                            <img src="/img/truk.png" class="img-fluid" alt="Oops" width="30%">
                        </div>
                        <div class="text-center">
                            <h4>Tidak ada Kendaraan Tersedia</h4>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{-- {{ $kendaraans->links() }} --}}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>

    <script>
        const labels = [
        @if($riwayat_service->count() > 0)
        @foreach($riwayat_service as $data)
            '{{ $data->kendaraan->plat_no }}' ,
        @endforeach
        @endif
        ];

        const data = {
            labels: labels,
            datasets: [{
                label: 'Jumlah Kendaraan Diservice Bulan {{ $bulan }}',
                data: [
                    @if($riwayat_service->count() > 0)
                    @foreach($riwayat_service as $data)
                        {{ $data->jumlah }} ,
                    @endforeach
                    @endif
                ],
                backgroundColor: [
                    @if($riwayat_service->count() > 0)
                    @foreach($riwayat_service as $data)
                    'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                    @endforeach
                    @endif
                ],
                borderColor: [
                    @if($riwayat_service->count() > 0)
                    @foreach($riwayat_service as $data)
                    'rgb(255, 102, 102)',
                    @endforeach
                    @endif
                ],
                borderWidth: 1
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            },
        };

        const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
    </script>

  <!-- /.card -->
@endsection
