@extends('layout.main')
@section('container')

<div class="pagetitle">
      <h1>Jenis Layanan Lova Laundry</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="">Paket Laundry</a></li>
          <li class="breadcrumb-item active">Jenis Layanan </li>
        </ol>
      </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
<div class="row">  
    <!-- Item Laundry --> 
        <div class="col">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Jenis Layanan</h5>

                  @if(session()->has('pesan'))
                  <div class="alert alert-success mt-2" role="alert">
                      {{ session('pesan') }}
                  </div>
                  @endif
                  
                  <div class="align-middle">
                    <h6><a href="/jenislayanan/create" class="badge bg-success">Insert</a></h6>
                  </div>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jenis Layanan</th>
                        <th scope="col">Harga/kg</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col"><i class="bi bi-gear-fill"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($jenislayanans as $jenislayanan)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td >{{ $jenislayanan->jns_layanan }}</td>
                          <td >Rp. {{ number_format($jenislayanan->harga_layanan, 0, ',', '.') }}</td>
                          <td >{{ $jenislayanan->deskripsi }}</td>
                        
                          <td >
                          <form  class="d-inline" action="/jenislayanan/{{ $jenislayanan->id }}" method="post">      
                            <a href="/jenislayanan/{{$jenislayanan->id}}/edit" class="badge bg-primary"><i class="bi bi-pencil-square"></i></a>
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