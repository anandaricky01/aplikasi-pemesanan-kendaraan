@extends('layout.layout')
@section('container')
<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Tambah Driver</h3>
      <div class="card-tools">
        <a href="/driver" class="btn btn-sm btn-warning float-right">
        <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
      </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    </br>

    @if (session()->has('error'))
        <div class="col-sm-10">
            <div class="alert alert-danger" role="alert">{!! session('error') !!}</div>
        </div>
    @endif

    <form class="form-horizontal" action="/driver/{{ $driver->id }}" method="post">
        @csrf
        @method('put')
      <div class="card-body">
        <div class="form-group row">
          <label for="Kategori Blog" class="col-sm-3 col-form-label">Nama Driver</label>
          <div class="col-sm-7">
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="Kategori Blog" value="{{ $driver->nama }}" name="nama">
            @error('driver')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        </div>
      </div>
      <input type="hidden" value="{{ $driver->id }}" name="id">
      <!-- /.card-body -->
      <div class="card-footer">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->
@endsection
