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
                <canvas id="myChartServicePerbulan" width="50"></canvas>
            </div>
            <div class="col">
                <canvas id="myChartServicePertahun" width="50"></canvas>
            </div>
        </div>

        <div class="mb-4"></div>

        <div class="row">
            <div class="col">
                <canvas id="myChartDigunakanPerbulan" width="50"></canvas>
            </div>
            <div class="col">
                <canvas id="myChartDigunakanPertahun" width="50"></canvas>
            </div>
        </div>

        <div class="mb-4"></div>

        <div class="row">
            <div class="col">
                <canvas id="myChartBBMPerbulan" width="50"></canvas>
            </div>
            <div class="col">
                <canvas id="myChartBBMPertahun" width="50"></canvas>
            </div>
        </div>

        <div class="mb-4"></div>

        <div class="row">
            <div class="col">
                <h3 class="text-center lead">Driver yang tersedia</h3>
                <div class="card">
                    @if ($driver_tersedia->count() > 0)
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">#</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($driver_tersedia as $data)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td> {{ $data->nama }}</td>
                                <td class="text-center"><span class="badge badge-primary">{{ $data->status }}</span></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    {{ $total_driver_tersedia > 0 ? 'Masih tersisa ' . $total_driver_tersedia . ' driver lainnya yang tersedia - ' : '' }}
                                     check <a href="/driver">di sini</a>
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
            <div class="col">
                <h3 class="text-center lead">Kendaraan yang tersedia</h3>
                <div class="card">
                    @if ($kendaraan_tersedia->count() > 0)
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Plat No</th>
                                <th scope="col" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kendaraan_tersedia as $data)
                            <tr>
                                <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                                <td class="text-center">{{ $data->plat_no }}</td>
                                <td class="text-center"><span class="badge badge-primary">{{ $data->status_kendaraan->status_kendaraan }}</span></td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">
                                    {{ $total_kendaraan_tersedia > 0 ? 'Masih tersisa ' . $total_kendaraan_tersedia . ' kendaraan lainnya yang tersedia - ' : '' }}
                                     check <a href="/kendaraan/tersedia">di sini</a>
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

        <div class="mb-4"></div>

        <div class="d-flex justify-content-center">
            {{-- {{ $kendaraans->links() }} --}}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>

    {{-- <script>
        // label riwayat service
        const labelsService = [
            @if($riwayat_service->count() > 0)
            @foreach($riwayat_service as $data)
                '{{ $data->kendaraan->plat_no }}' ,
            @endforeach
            @endif
        ];

        // label riwayat digunakan
        const labelsDigunakan = [
            @if($riwayat_digunakan->count() > 0)
            @foreach($riwayat_digunakan as $data)
            '{{ $data->kendaraan->plat_no }}' ,
            @endforeach
            @endif
        ];

        // label BBM Perbulan
        const labelsBBMPerbulan = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];


        // data riwayat service
        const dataService = {
            labels: labelsService,
            datasets: [{
                label: "Jumlah Kendaraan Diservice Bulan {{ $bulan->format('F Y') }}",
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

        // data riwayat digunakan
        const dataDigunakan = {
            labels: labelsDigunakan,
            datasets: [{
                label: 'Jumlah Kendaraan Dalam Ekspedisi {{ $bulan->format("F Y") }}',
                data: [
                    @if($riwayat_digunakan->count() > 0)
                    @foreach($riwayat_digunakan as $data)
                        {{ $data->jumlah }} ,
                    @endforeach
                    @endif
                ],
                backgroundColor: [
                    @if($riwayat_digunakan->count() > 0)
                    @foreach($riwayat_digunakan as $data)
                    'rgba({{ rand(54,150) }}, {{ rand(54,150) }}, {{ rand(54,150) }}, 0.2)',
                    @endforeach
                    @endif
                ],
                borderColor: [
                    @if($riwayat_digunakan->count() > 0)
                    @foreach($riwayat_digunakan as $data)
                    'rgb(255, 102, 102)',
                    @endforeach
                    @endif
                ],
                borderWidth: 1
            }]
        };

        // data BBM Perbulan
        const dataBBMPerbulan = {
            labels: labelsBBMPerbulan,
            datasets: [{
                label: 'Konsumsi BBM/Bulan Tahun {{ $bulan->format("Y") }}',
                data: [
                    @foreach($bbm_perbulan as $bbm)
                        {{ $bbm }} ,
                    @endforeach
                ],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        // config riwyat service
        const configService = {
            type: 'bar',
            data: dataService,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            },
        };

        // config riwayat digunakan
        const configDigunakan = {
            type: 'bar',
            data: dataDigunakan,
            options: {
                scales: {
                y: {
                    beginAtZero: true
                }
                }
            },
        };

        // config
        const configBBMPerbulan = {
            type: 'line',
            data: dataBBMPerbulan,
            options:{
                scales:{
                    y: {
                        title: {
                            display: true,
                            text: 'Liter'
                        }
                    }
                }
            }
        };

        // chart riwayat service
        const myChartService = new Chart(
            document.getElementById('myChartService'),
            configService
        );

        // chart riwayat digunakan
        const myChartDigunakan = new Chart(
            document.getElementById('myChartDigunakan'),
            configDigunakan
        );

        const myChartBBM = new Chart(
            document.getElementById('myChartBBM'),
            configBBMPerbulan
        );

    </script> --}}
    @include('js-home.js-home')
  <!-- /.card -->
@endsection
