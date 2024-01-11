@extends('layout.main')
@section('container')

<div class="pagetitle">
      <h1>Paket Laundry</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
          <li class="breadcrumb-item active">Layanan Khusus</li>
        </ol>
      </nav>
</div><!-- End Page Title -->

<section class="section dashboard">
    
<div class="row">  
    <!-- Item Laundry --> 
        <div class="col">
              <div class="card recent-sales overflow-auto">
                <div class="card-body">
                  <h5 class="card-title">Layanan Khusus lova laundry </h5>

                  @if(session()->has('pesan'))
                  <div class="alert alert-success mt-2" role="alert">
                      {{ session('pesan') }}
                  </div>
                  @endif
                  <div class="align-middle">
                    <h6><a href="/layananKhusus/create" class="badge bg-success">Insert</a></h6>
                  </div>
                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Layanan Khusus</th>
                        <th scope="col">Harga</th>
                        <th scope="col"><i class="bi bi-gear-fill"></i></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($layanan_khususes as $layananKhusus)
                      <tr>
                          <td scope="row">{{ $loop->iteration }}</td>
                          <td >{{ $layananKhusus->lyn_khusus }}</td>
                          <td >Rp. {{ number_format($layananKhusus->harga_khusus, 0, ',', '.') }}</td>
                          <td >
                          <form  class="d-inline" action="/layananKhusus/{{ $layananKhusus->id }}" method="post">      
                            <a href="/layananKhusus/{{$layananKhusus->id}}/edit" class="badge bg-primary"><i class="bi bi-pencil-square"></i></a>
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