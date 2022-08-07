@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> List Kendaraan Pending</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session()->has('success'))
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">{!! session('error') !!}</div>
            </div>
        @endif

        {{-- search --}}
        <div class="container-fluid">
            <form action="/pending" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="contoh : Ayu Lestari" aria-label="Recipient's username" aria-describedby="button-addon2" name="nama" value="{{ Request::is('nama') != null ? Request::is('nama') : '' }}">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                </div>
            </form>
        </div>
        {{-- /search --}}

        @if ($pendings->count() > 0)
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
                    @foreach ($pendings as $pending)
                    <tr>
                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pending->kendaraan->plat_no }}</td>
                        <td>{{ $pending->driver->nama }}</td>
                        <td>{{ $pending->kode_kegiatan }}</td>
                        <td>{{ $pending->bbm_liter }}</td>
                        <td>{{ $pending->tujuan }}</td>
                        <td>{{ $pending->tanggal_digunakan }}</td>
                        <td>{{ $pending->tanggal_selesai }}</td>
                        <td>{{ $pending->user->name }}</td>
                        <td class="text-center">
                            <h5>
                                @if(Auth::user()->role_id == '2')
                                    @if ($pending->status == 'pending')
                                        @if(Auth::user()->id == $pending->user_id)
                                            <form action="/kendaraan/pending/{{ $pending->id }}/setujui" class="d-inline" method="post">
                                                @csrf
                                                <button class="btn badge bg-primary" type="submit" onclick="return confirm('Apakah Pesanan Disetujui?')">Setujui</button>
                                            </form>
                                            <form action="/kendaraan/pending/{{ $pending->id }}/tolak" class="d-inline" method="post">
                                                @csrf
                                                <button class="btn badge bg-danger" type="submit" onclick="return confirm('Apakah Pesanan Ditolak?')">Tolak</button>
                                            </form>
                                        @else
                                            <form action="/kendaraan/pending/{{ $pending->id }}/setujui" class="d-inline" method="post">
                                                @csrf
                                                <button class="btn badge bg-primary" type="submit" onclick="return confirm('Apakah Pesanan Disetujui?')" disabled>Setujui</button>
                                            </form>
                                            <form action="/kendaraan/pending/{{ $pending->id }}/tolak" class="d-inline" method="post">
                                                @csrf
                                                <button class="btn badge bg-danger" type="submit" onclick="return confirm('Apakah Pesanan Ditolak?')" disabled>Tolak</button>
                                            </form>
                                        @endif
                                    @elseif($pending->status == 'disetujui')
                                        <button class="btn badge bg-primary" type="button" disabled>Disetujui</button>
                                    @else
                                        <button class="btn badge bg-danger" type="button" disabled>Ditolak</button>
                                    @endif
                                @else
                                    @if ($pending->status == 'pending')
                                        <button class="btn badge bg-warning" type="button" disabled>Pending</button>
                                    @elseif($pending->status == 'disetujui')
                                        <button class="btn badge bg-primary" type="button" disabled>Disetujui</button>
                                    @else
                                        <button class="btn badge bg-danger" type="button" disabled>Ditolak</button>
                                    @endif
                                @endif
                            </h5>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      @else
      <div class="text-center">
          <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
      </div>
        <h1 class="text-center"><strong>Belum Ada Pesanan Kendaraan</strong></h1>
      @endif
        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{ $pendings->links() }}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>
@endsection
