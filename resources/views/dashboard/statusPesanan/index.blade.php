@extends('layout.main')
@section('container')

<div class="pagetitle">
      <h1>Status Pesanan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="/status_pesanan">Status Pesanan</a></li>
        </ol>
      </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
<div class="row">  
    <!-- Item Laundry --> 
        <div class="col">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Data Status Pesanan</h5>
                 
                  @if(session()->has('pesan'))
                  <div class="alert alert-success mt-2" role="alert">
                      {{ session('pesan') }}
                  </div>
                  @endif
                  <div class="align-middle">
                    <h6><a href="/status_pesanan/create" class="badge bg-success">Insert</a></h6>
                  </div>

                  <table class="table table-borderless datatable" action="/status_pesanan" method="post">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama Status</th>
                        <th scope="col">Urutan</th>
                        <th scope="col"><i class="bi bi-gear-fill"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($statuspesanans as $statuspesanan)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td >{{ $statuspesanan->nama_status }}</td>
                          <td >{{ $statuspesanan->urutan }}</td>
                          <td >
                          <form  class="d-inline" action="/status_pesanan/{{ $statuspesanan->id }}" method="post">      
                            <a href="/status_pesanan/{{$statuspesanan->id}}/edit" class="badge bg-primary"><i class="bi bi-pencil-square"></i></a>
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
        </div>
    <!-- Item Laundry -->

</div>
   
</section>
@endsection