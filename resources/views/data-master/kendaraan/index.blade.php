@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> List Kendaraan</h3>
        <div class="card-tools">
            <a href="/kendaraan/create" class="btn btn-sm btn-info float-right">
            <i class="fas fa-plus"></i>Tambah Kendaraan</a>
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
                    <input type="text" class="form-control" placeholder="contoh : N 5570 Q6O" aria-label="Recipient's username" aria-describedby="button-addon2" name="plat_no" value="{{ Request::is('plat_no') != null ? $request->plat_no : '' }}">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                </div>
            </form>
        </div>
        {{-- /search --}}

        @if ($kendaraans->count() > 0)
        <div class="card">    
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Kendaraan (Plat Nomor)</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($kendaraans as $kendaraan)
                    <tr>
                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $kendaraan->plat_no }}</td>
                        <td class="text-center"> 
                        @if ($kendaraan->status_kendaraan_id == 1)
                            <button type="button" class="btn btn-sm btn-primary" disabled>{{ $kendaraan->status_kendaraan->status_kendaraan }}</button>
                        @elseif($kendaraan->status_kendaraan_id == 2)
                            <button type="button" class="btn btn-sm btn-danger" disabled>{{ $kendaraan->status_kendaraan->status_kendaraan }}</button>
                        @else
                            <button type="button" class="btn btn-sm btn-warning" disabled>{{ $kendaraan->status_kendaraan->status_kendaraan }}</button>
                        @endif
                        </td>
                        <td class="text-center">
                            <h5>
                                <a href="/kendaraan/{{ $kendaraan->id }}/edit"><span class="badge bg-primary">Edit</span></a>
                                <form action="/kendaraan/{{ $kendaraan->id }}/service" class="d-inline" method="post">
                                    @csrf
                                    <button class="btn badge bg-warning" type="submit" onclick="return confirm('Kirim kendaraan ke Service?')" {{ $kendaraan->status_kendaraan_id == 3 || $kendaraan->status_kendaraan_id == 2 ? 'disabled' : ''}}>Service</button>
                                </form>
                                <form action="/kendaraan/{{ $kendaraan->id }}" class="d-inline" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn badge bg-danger" type="submit" onclick="return confirm('Kamu yakin ingin menghapus {{ $kendaraan->plat_no }}?')">Delete</button>
                                </form>
                            </h5>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      @else
      <div class="text-center">
          <img src="/img/truk.png" class="img-fluid" alt="Oops" width="30%">
      </div>
        <h1 class="text-center"><strong>Kendaraan Kosong</strong></h1>
      @endif
        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{ $kendaraans->links() }}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>
@endsection