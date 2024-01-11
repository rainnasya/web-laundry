@extends('layout.main')
@section('container')

<div class="pagetitle">
      <h1>Laporan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Laporan</li>
        </ol>
      </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
<div class="row">   
     <div class="col">
        <div class="card overflow-auto">
            <div class="card-body">
                <h5 class="card-title">Laporan Order Masuk</h5><hr>                
                    <div class="row">
                        <div class="row mb-2">
                            <div class="align-middle">
                                <h6><a href="{{url('cetaksemua/')}}" class="btn btn-primary"><i class="bi bi-printer-fill"></i> Semua Order</a></h6>
                            </div>
                        </div> 
                        <div class="row mb-3">
                            <div class="align-middle">
                                <h6><button class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#cetak_order">
                                    <i class="bi bi-funnel-fill"></i> Berdasarkan Tanggal</button></h6>
                            </div>
                        </div> 
                        <form method="get" action="">
                            <div class="modal fade" id="cetak_order" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Cetak Berdasarkan Tanggal pemasukan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Dari Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="tglawal" name="tglawal">
                                                </div>
                                            </div>
                                        
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Sampai Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" id="tglakhir" name="tglakhir">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <a href=""  onclick="this.href='/cetakpertanggal/' + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value "
                                            target="_blank" class="btn btn-success"><i class="bi bi-printer-fill"></i> Print</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                     </div>    
            </div>
        </div>
    </div>
</div>
</section>


@endsection
