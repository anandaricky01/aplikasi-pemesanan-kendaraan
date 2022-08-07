@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Kendaraan yang sedang digunakan</h3>
        @if(Auth::user()->role_id == 1)
            <div class="card-tools">
                <a href="/pesan-kendaraan/create" class="btn btn-sm btn-primary float-right">
                <i class="fas fa-plus"></i> Tambah Kendaraan</a>
            </div>
        @endif
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session()->has('success'))
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            </div>
        @endif

        {{-- search --}}
        <div class="container-fluid">
            <form action="/kendaraan" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="contoh : N 5570 Q6O" aria-label="Recipient's username" aria-describedby="button-addon2" name="plat_no">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                </div>
            </form>
        </div>
        {{-- /search --}}

            @if ($kendaraan_digunakan->count() > 0)
            <div class="card">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Plat Nomor</th>
                        <th class="text-center">Driver</th>
                        <th class="text-center">Kode Kegiatan</th>
                        <th class="text-center">BBM (Liter)</th>
                        <th class="text-center">Tujuan</th>
                        <th class="text-center">Tanggal Digunakan</th>
                        <th class="text-center">Tanggal Selesai</th>
                        <th class="text-center">Penanggungjawab</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraan_digunakan as $data)
                        <tr>
                            <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->kendaraan->plat_no }}</td>
                            <td>{{ $data->driver->nama }}</td>
                            <td>{{ $data->kode_kegiatan }}</td>
                            <td>{{ $data->bbm_liter }}</td>
                            <td>{{ $data->tujuan }}</td>
                            <td>{{ $data->tanggal_digunakan }}</td>
                            <td>{{ $data->tanggal_selesai }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td class="text-center">
                                <h5>
                                    <form action="/pesan-kendaraan/{{ $data->id }}/selesai-digunakan" class="d-inline" method="post">
                                        @csrf
                                        <button class="btn badge bg-primary" type="submit" onclick="return confirm('Apakah Pesanan Disetujui?')">Selesai</button>
                                    </form>
                                </h5>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center mb-2">
                <img src="/img/truk.png" class="img-fluid" alt="Oops" width="30%">
            </div>
            <h3 class="text-center"><strong>Tidak ada Kendaraan yang sedang digunakan</strong></h3>
                @if(Auth::user()->role_id == 1)
                    <div class="text-center">
                        <a class="btn btn-primary btn-sm" href="/pesan-kendaraan/create">+ Pesan Kendaraan</a>
                    </div>
                @endif
            @endif

        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{-- {{ $kendaraans->links() }} --}}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>



@endsection
