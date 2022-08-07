@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Kendaraan yang sedang digunakan</h3>
        <div class="card-tools">
            <a href="/pesan-kendaraan/create" class="btn btn-sm btn-primary float-right">
            <i class="fas fa-plus"></i> Tambah Kendaraan</a>
        </div>
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
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Plat No</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kendaraan_digunakan as $data)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $data->kendaraan->plat_no }}</td>
                            <td><span class="badge badge-primary">{{ $data->kendaraan->status_kendaraan->status_kendaraan }}</span></td>
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
            <div class="text-center">
                <a class="btn btn-primary btn-sm" href="/pesan-kendaraan/create">+ Pesan Kendaraan</a>
            </div>
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
