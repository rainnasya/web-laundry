@extends('layout.main')
@section('container')

@php

        $jumlahPesanan = App\Models\Pesanan::count();
        $totalPemasukan = App\Models\Pesanan::sum('harga');
        $jumlahPelanggan = App\Models\Pelanggan::count();
        $pelanggans = App\Models\Pelanggan::with('user')->paginate(5);

@endphp

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col">
          <div class="row">

            <!-- Total Pesanan -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card order-card">

                <div class="card-body">
                  <h5 class="card-title">Total Pesanan <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $jumlahPesanan }}</h6>
                      <span class="text-primary small pt-1 fw-bold">Pesanan</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- Total Pesanan -->

            <!-- Total Pemasukan -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card total-order-card">

                <div class="card-body">
                  <h5 class="card-title">Total Pemasukan <span>| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6>Rp. {{ number_format($totalPemasukan, 2) }}</h6>
                      <span class="text-success small pt-1 fw-bold">Pemasukan</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- Total Pemasukan -->

            <!-- Total Pelanggan -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card pelanggan-card">

                <div class="card-body">
                  <h5 class="card-title">Data Pelanggan</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ @count($pelanggans) }}</h6>
                      <span class="text-danger small pt-1 fw-bold">Pelanggan</span> 

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- Total Pelanggan -->

            <!-- Data Pelanggan -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <div class="card-body">
                  <h5 class="card-title">Data Pelanggan </h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Nama Pelanggan</th>
                        <th scope="col">Email Pelanggan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telp</th>
                        <th scope="col"><i class="bi bi-gear-fill"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($pelanggans as $pelanggan)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td >{{ $pelanggan->user->username}}</td>
                          <td >{{ $pelanggan->nama_pelanggan}}</td>
                          <td >{{ $pelanggan->user->email}}</td>
                          <td >{{ $pelanggan->alamat }}</td>
                          <td >{{ $pelanggan->telp }}</td>
                          <td >
                              <a href="{{ route('dashboard.show', $pelanggan->id) }}" class="badge bg-primary"><i class="bi bi-eye-fill"></i></a>
                          <form  class="d-inline" action="/dashboard/{{ $pelanggan->id }}" method="post">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger" onclick="return confirm('Yakin ingin menghapus data ?')"><i class="bi bi-trash"></i></button>
                          </form>
                              </td>
                          </tr>

                      @endforeach

                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- Data Pelanggan -->
            

      </div>
    </section>

  <!-- End #main -->





@endsection