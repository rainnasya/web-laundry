@extends('layout.main')
@section('container')

<div class="pagetitle">
    <h1>Form Layanan Khusus Lova Laundry</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/layananKhusus">Layanan Khusus</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="p-2 card">
                <div class="card-body">
                <h5 class="card-title">Tambah Layanan Khusus</h5>
   
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
                <form  action="/layananKhusus" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Layanan Khusus</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="lyn_khusus" name="lyn_khusus" value="{{old('lyn_khusus')}}">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Harga</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_khusus" name="harga_khusus">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-primary">Submit Form</button>
                    </div>
                </div>

                </form><!-- End General Form Elements -->

                </div>
        </div>
    </div>
</div>



@endsection