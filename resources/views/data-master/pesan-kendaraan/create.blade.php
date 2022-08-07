@extends('layout.layout')
@section('container')
<div class="card card-info">
    <div class="card-header">
      <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pesan Kendaraan</h3>
      <div class="card-tools">
        <a href="/pesan-kendaraan" class="btn btn-sm btn-warning float-right">
        <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
      </div>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    </br>

    @if (session()->has('error'))
        <div class="col-sm-10">
            <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
        </div>
    @endif

    @if ($kendaraans->count() == 0 || $drivers->count() == 0)
    <div class="container-fluid">
        <div class="alert alert-danger" role="alert">
            Tidak ada Kendaraan atau Driver yang sedang tersedia! Silahkan tunggu ada yang selesai!
        </div>
    </div>
    @endif

    <form class="form-horizontal" action="/pesan-kendaraan" method="post">
        @csrf
      <div class="card-body">
        {{-- Plat Nomor --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Plat Nomor</label>
            <div class="col-sm-7">
                @if ($kendaraans->count() > 0)
                    <select class="form-control" name="kendaraan_id">
                        @foreach ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}">{{ $kendaraan->plat_no }}</option>
                        @endforeach
                    </select>
                    @error('kendaraan_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                @else
                    <select class="form-control" disabled>
                        <option>Tidak ada Kendaraan yang tersedia</option>
                    </select>
                @endif
            </div>
        </div>

        {{-- Driver --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Driver</label>
            <div class="col-sm-7">
                @if ($drivers->count() > 0)
                    <select class="form-control @error('driver_id') is-invalid @enderror" name="driver_id">
                        @foreach ($drivers as $driver)
                            <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                        @endforeach
                        </select>
                    @error('driver_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                @else
                    <select class="form-control" name="drivers" disabled>
                        <option>Tidak ada Driver yang tersedia</option>
                    </select>
                @endif

            </div>
        </div>

        {{-- Kode Kegiatan --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Kode Kegiatan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control @error('kode_kegiatan') is-invalid @enderror" id="inputError" placeholder="Enter ..." name="kode_kegiatan">
                @error('kode_kegiatan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Konsumsi BBM Liter --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Konsumsi BBM (Liter)</label>
            <div class="col-sm-7">
                <input type="text" class="form-control @error('bbm_liter') is-invalid @enderror" id="inputError" placeholder="Enter ..." name="bbm_liter">
                @error('bbm_liter')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Tujuan --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Tujuan</label>
            <div class="col-sm-7">
                <input type="text" class="form-control @error('tujuan') is-invalid @enderror" id="inputError" placeholder="Enter ..." name="tujuan">
                @error('tujuan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        {{-- Tanggal Berangkat --}}
        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">Tanggal Digunakan</label>
            <div class="col-sm-7">
                <input type="text" name="tanggal_digunakan" id="datepicker" class="form-control @error('tanggal_digunakan') is-invalid @enderror" autocomplete="off"/>
                @error('tanggal_digunakan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="Kategori Blog" class="col-sm-3 col-form-label">(Perkiraan)Tanggal Selesai</label>
            <div class="col-sm-7">
                <input type="text" name="tanggal_selesai" id="datepicker1" class="form-control @error('tanggal_selesai') is-invalid @enderror" autocomplete="off" />
                @error('tanggal_selesai')
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
          <button type="submit" class="btn btn-info float-right" {{ $kendaraans->count() == 0 || $drivers->count() == 0 ? 'disabled' : '' }}><i class="fas fa-save"></i> Simpan</button>
        </div>
      </div>
      <!-- /.card-footer -->
    </form>
  </div>
  <!-- /.card -->
@endsection
