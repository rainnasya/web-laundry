@extends('layout.main')
@section('container')

<div class="pagetitle">
    <h1>Form Pelanggan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="p-2 card">
                <div class="card-body">
                <h5 class="card-title">Edit Jenis Layanan Laundry</h5>
   
                <!-- General Form Elements -->
                <form  action="/jenislayanan/{{ $jenislayanans->id }}" method="post">
                @method('put')
                @csrf
              

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Layanan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('jns_layanan') is-invalid @enderror" id="jns_layanan" name="jns_layanan" value="{{ old('jns_layanan',$jenislayanans->jns_layanan) }}">
                    </div>
                </div>
              
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"> Harga/kg</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('harga_layanan') is-invalid @enderror" id="harga_layanan" name="harga_layanan" value="{{ old('harga_layanan',$jenislayanans->harga_layanan) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi">{{ old('deskripsi',$jenislayanans->deskripsi) }}</textarea>
                    </div>
                </div>
           
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                </div>
                

                </form><!-- End General Form Elements -->

                </div>
        </div>
    </div>
</div>



@endsection