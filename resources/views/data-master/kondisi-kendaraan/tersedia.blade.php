@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> List Kendaraan Tersedia</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if (session()->has('success'))
            <div class="col-sm-12">
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            </div>
        @endif
        
        {{-- search --}}
        <h2 class="text-center mt-3 mb-4">List Kendaraan Tersedia</h2>
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