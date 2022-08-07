@extends('layout.layout')

@section('container')
<div class="card">
    <div class="card-header">
        <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> List Driver</h3>
        <div class="card-tools">
            <a href="/driver/create" class="btn btn-sm btn-info float-right">
            <i class="fas fa-plus"></i>Tambah Driver</a>
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
            <form action="/driver" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="contoh : Ayu Lestari" aria-label="Recipient's username" aria-describedby="button-addon2" name="nama" value="{{ Request::is('nama') != null ? Request::is('nama') : '' }}">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">cari</button>
                </div>
            </form>
        </div>
        {{-- /search --}}

        @if ($drivers->count() > 0)
        <div class="card">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($drivers as $driver)
                    <tr>
                        <th class="text-center" scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $driver->nama }}</td>
                        <td class="text-center">
                        @if ($driver->status == 'tersedia')
                            <button type="button" class="btn btn-sm btn-primary" disabled>{{ $driver->status }}</button>
                        @elseif($driver->status == 'sedang bertugas')
                            <button type="button" class="btn btn-sm btn-danger" disabled>{{ $driver->status }}</button>
                        @else
                            <button type="button" class="btn btn-sm btn-warning" disabled>{{ $driver->status }}</button>
                        @endif
                        </td>
                        <td class="text-center">
                            <h5>
                                <a href="driver/{{ $driver->id }}/edit"><span class="badge bg-primary">Edit</span></a>
                                @if ($driver->status == 'tersedia')
                                    <form action="driver/{{ $driver->id }}/cuti" class="d-inline" method="post">
                                        @csrf
                                        <button class="btn badge bg-warning" type="submit" onclick="return confirm('Apakah Driver Mengambil Cuti?')">Cuti</button>
                                    </form>
                                @elseif($driver->status == 'sedang bertugas')
                                    <form action="driver/{{ $driver->id }}/cuti" class="d-inline" method="post">
                                        @csrf
                                        <button class="btn badge bg-warning" type="submit" onclick="return confirm('Apakah Driver Mengambil Cuti?')" disabled>Cuti</button>
                                    </form>
                                @else
                                    <form action="driver/{{ $driver->id }}/selesai-cuti" class="d-inline" method="post">
                                        @csrf
                                        <button class="btn badge bg-warning" type="submit" onclick="return confirm('Apakah Driver Selesai Cuti?')">Selesai Cuti</button>
                                    </form>

                                @endif
                                <form action="driver/{{ $driver->id }}" class="d-inline" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn badge bg-danger" type="submit" onclick="return confirm('Kamu yakin ingin menghapus {{ $driver->nama }}?')">Delete</button>
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
          <h1><i class="fa fa-users" aria-hidden="true"></i></h1>
      </div>
        <h1 class="text-center"><strong>driver Kosong</strong></h1>
      @endif
        <div class="mb-3"></div>

        <div class="d-flex justify-content-center">
            {{ $drivers->links() }}
        </div>
    </div>
    <!-- /.card-body -->
    {{-- <div class="card-footer clearfix">&nbsp;</div> --}}
  </div>
@endsection
