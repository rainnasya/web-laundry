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
                <h5 class="card-title">Edit Item Laundry</h5>
   
                <!-- General Form Elements -->
                <form  action="/layananKhusus/{{ $layanan_khususes->id }}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
              
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Layanan Khusus</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('lyn_khusus') is-invalid @enderror" id="lyn_khusus" 
                        name="lyn_khusus" value="{{ old('lyn_khusus',$layanan_khususes->lyn_khusus) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"> Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control @error('harga_khusus') is-invalid @enderror" id="harga_khusus" name="harga_khusus" 
                        value="{{ old('harga_khusus',$layanan_khususes->harga_khusus) }}">
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