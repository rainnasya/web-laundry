@extends('layout.main')
@section('container')

<div class="pagetitle">
    <h1>Form Pesanan</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/pesanan">Pesanan</a></li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="row">
<div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="p-2 card">
                <div class="card-body">
                <h5 class="card-title">Edit Pesanan</h5>
   
                <!-- General Form Elements -->
                <form  action="/pesanan/{{ $pesanans->id }}" method="post">
                @method('put')
                @csrf
                

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label" for="statuspembayaran">Status Pembayaran</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="statuspembayaran" name="statuspembayaran">
                                <option value="belum_bayar" {{ $pesanans->statuspembayaran === 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="lunas" {{ $pesanans->statuspembayaran === 'lunas' ? 'selected' : '' }}>Lunas</option>
                            </select>
                        </div>
                    </div>

                   

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Status Pesanan</label>
                        <div class="col-sm-9">
                            <select class="form-select" id="statuspesanan_id" name="statuspesanan_id">
                                @foreach ($statuspesanans as $statuspesanan)
                                <option value="{{ $statuspesanan->id }}" @if($statuspesanan->id === $pesanans->statuspesanan_id) selected @endif>{{ $statuspesanan->nama_status }}</option>
                                @endforeach
                            </select>
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