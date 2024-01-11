@extends('layout.main')
@section('container')

<div class="pagetitle">
    <h1>Form Status Pesanan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/status_pesanan">Status Pesanan</a></li>
          <li class="breadcrumb-item active">Create</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="p-2 card">
                <div class="card-body">
                <h5 class="card-title">Tambah Status Pesanan</h5>
   
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
                <form  action="/status_pesanan" method="post" >
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Nama Status</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama_status" name="nama_status" value="{{old('nama_status')}}">
                    </div>
                </div>
               
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label">Urutan</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="urutan" name="urutan" value="{{old('urutan')}}">
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