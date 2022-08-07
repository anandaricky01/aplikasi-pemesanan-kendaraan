@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Riwayat Service Kendaraan</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        {{-- <div class="col-sm-12">
            <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
        </div> --}}

        {{-- <h2 class="text-center mt-3 mb-4">Riwayat Penggunaan Kendaraan</h2> --}}
        @if ($riwayat->count() > 0)
        <div class="card">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kendaraan (Plat Nomor)</th>
                    <th scope="col">Tanggal Service</th>
                    <th scope="col">Tanggal Selesai</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $r)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $r->kendaraan->plat_no }}</td>
                        <td>{{ $r->tanggal_service }}</td>
                        <td>{{ $r->tanggal_keluar == NULL ? 'Sedang Service' : $r->tanggal_keluar }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="7">Total Data : {{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      @else
      <div class="text-center">
          <img src="/img/truk.png" class="img-fluid" alt="Oops" width="30%">
      </div>
        <h1 class="text-center"><strong>Riwayat Kosong</strong></h1>
      @endif
        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{ $riwayat->links() }}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>
@endsection
