@extends('layout.layout')
@section('container')
<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Kendaraan</h3>
      <div class="card-tools">
        <a href="/kendaraan" class="btn btn-sm btn-warning float-right">
        <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
      </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    </br>

    @if (session()->has('error'))
        <div class="col-sm-10">
            <div class="alert alert-danger" role="alert">Edit Gagal</div>
        </div>
    @endif
    
    <form class="form-horizontal" action="/kendaraan/{{ $kendaraan->id }}" method="post">
        @csrf
        @method('put')
      <div class="card-body">
        <div class="form-group row">
          <label for="Kategori Blog" class="col-sm-3 col-form-label">Plat Nomor</label>
          <div class="col-sm-7">
            <input type="text" class="form-control @error('plat_no') is-invalid @enderror" id="Kategori Blog" value="{{ $kendaraan->plat_no }}" name="plat_no">
            @error('plat_no')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        </div>
      </div>
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