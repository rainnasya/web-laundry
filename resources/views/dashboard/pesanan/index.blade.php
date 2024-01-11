@extends('layout.main')
@section('container')

@php use Illuminate\Support\Str; @endphp

<div class="pagetitle">
      <h1>Pesanan Lova Laundry</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Pesanan</li>
        </ol>
      </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
<div class="row">  
    <!-- Item Laundry --> 
        <div class="col">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Pesanan Masuk</h5>

                  @if(session()->has('pesan'))
                  <div class="alert alert-success mt-2" role="alert">
                      {{ session('pesan') }}
                  </div>
                  @endif

                  @if (Session::has('success'))
                      <div class="alert alert-success">
                          {{ Session::get('success') }}
                      </div>
                  @endif

                  @if (Session::has('error'))
                      <div class="alert alert-danger">
                          {{ Session::get('error') }}
                      </div>
                  @endif
                  
                  <div class="row mb-3">
                   
  
                    <div class="col-lg-8">
                      <form action="{{ route('pesanan.index') }}" method="get" class="form-inline">
                          @csrf
                          <div class="form-group row">
                          <label class="col-lg-3 col-form-label text-right">Status Pesanan</label>
                              <div class="col-lg-5">
                                  <select name="filter_status" class="form-control">
                                      <option value="">Semua</option>
                                      @foreach ($statuspesanans as $statuspesanan)
                                          <option value="{{ $statuspesanan->nama_status }}"{{ $filterStatus == $statuspesanan->nama_status ? ' selected' : '' }}>
                                              {{ $statuspesanan->nama_status }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-2">
                                  <button type="submit" class="btn btn-primary">Filter</button>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
                  
                 
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col"><i class="bi bi-gear-fill"></i></th>
                        <th scope="col">Kd Pesanan</th>
                        <th scope="col">Tgl Pesanan</th>
                        <th scope="col">Pembayaran</th>
                        <th scope="col">Pelanggan</th>
                        <th scope="col">Paket</th>
                        <th scope="col">Berat</th>
                        <th scope="col">L.Khusus</th>
                        <th scope="col">Jml L.Khusus</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Status Pesanan</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Update</th>
                        <th scope="col">Cetak</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($pesanans as $pesanan)
                      <tr>
                          <td>
                         
                            <form  class="d-inline" action="/pesanan/{{ $pesanan->id }}" method="post">      
                              <a href="/pesanan/{{$pesanan->id}}/edit" class="badge bg-primary"><i class="bi bi-pencil-square"></i></a>
                              @method('delete')
                              @csrf
                              <button class="badge bg-danger" onclick="return confirm('Yakin ingin menghapus data ?')"><i class="bi bi-trash"></i></button>
                            </form>
                       
                          </td>
                          <td >{{ $pesanan->kd_pesanan }}</td>
                          <td >{{ $pesanan->tgl_pesanan }}</td>
                          <td >{{ $pesanan->statuspembayaran}}</td>
                          <td >{{ $pesanan->pelanggan->nama_pelanggan}}</td>
                          <td >{{ $pesanan->jenislayanan ? $pesanan->jenislayanan->jns_layanan : 'Tidak Memilih' }}</td>
                          <td >{{ $pesanan->berat }} Kg</td>
                          <td>{{ $pesanan->layananKhusus ? $pesanan->layananKhusus->lyn_khusus : 'Tidak Memilih' }}</td>
                          <td>{{ $pesanan->jml_layanankhusus}} pcs</td>
                          <td>{{ Str::limit($pesanan->catatan, 20) }}</td>
                          <td>{{ $pesanan->statuspesanan->nama_status}}</td>
                          <td>Rp. {{ number_format($pesanan->harga, 2) }}</td>
                          <td>  
                            <form  class="d-inline" action="/pesanan/{{ $pesanan->id }}" method="post">      
                              <a href="{{url('pesanan/naikkan-status/'.$pesanan->id)}}" class="badge bg-success"><i class="bi bi-caret-up-fill"></i></a>
                            </form>  
                          </td> 
                          <td>  
                            <form  class="d-inline" action="/pesanan/{{ $pesanan->id }}" method="post">      
                              <a href="{{url('pesanan/print/'.$pesanan->id)}}" class="badge bg-warning"><i class="bi bi-printer-fill"></i></a>
                            </form>  
                          </td>

                      </tr>

                      @endforeach
                   
                    </tbody>
                  </table>

                </div>

            </div>
        </div>
    <!-- Item Laundry -->

</div>
   
</section>
@endsection