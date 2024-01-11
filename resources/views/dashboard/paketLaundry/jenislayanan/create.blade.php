@extends('layout.main')
@section('container')

<div class="pagetitle">
    <h1>Form Jenis Layanan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Paket Laundry</a></li>
          <li class="breadcrumb-item"><a href="/jenislayanan">Jenis Layanan</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="p-2 card">
                <div class="card-body">
                <h5 class="card-title">Tambah Jenis Layanan</h5>
   
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- General Form Elements -->
                <form  action="/jenislayanan" method="post" >
                @csrf           
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Jenis Layanan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="jns_layanan" name="jns_layanan" value="{{old('jns_layanan')}}">
                    </div>
                </div>
               
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Harga/kg</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="harga_layanan" name="harga_layanan" value="{{old('harga_layanan')}}">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" style="height: 100px" id="deskripsi" name="deskripsi" value="{{old('deskripsi')}}"></textarea>
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