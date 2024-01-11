<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
 

    <div class="container mb-5 mt-3">
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9 text-center">
          <ul>
            <h5 style="color: #7e8d9f;font-size: 20px;">LOVA LAUNDRY</h5>
            <h6 style="color: #7e8d9f;font-size: 17px;">Jasa Cuci Kiloan Berkualitas</h6>
            <h6 style="color: #7e8d9f;font-size: 17px;">Bersih - Rapi - Wangi</h6>
          </ul>
        </div>
        <hr>
      </div>

      <div class="container">
        <div class= "row">
            <div class="col-xl-8">
                <ul class="list-unstyled">
                <li class="text-muted">Pelanggan: <span style="color:#5d9fc5 ;">{{ $pesanan->pelanggan->nama_pelanggan}}</span></li>
                <li class="text-muted">{{ $pesanan->pelanggan->alamat}}</li>
                <li class="text-muted"><i class="bi bi-telephone-fill"></i> {{ $pesanan->pelanggan->telp }}</li>
                </ul>
            </div>
            <div class="col-xl-4">
                <p class="text-muted">Invoice</p>
                <ul class="list-unstyled">
                <li class="text-muted"><i class="bi bi-circle-fill" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">KD: </span> {{ $pesanan->kd_pesanan}}</li>
                <li class="text-muted"><i class="bi bi-circle-fill" style="color:#84B0CA ;"></i> <span
                    class="fw-bold">Tanggal Masuk: </span> {{ $pesanan->tgl_pesanan}}</li>
                <li class="text-muted"><i class="bi bi-circle-fill" style="color:#84B0CA ;"></i> <span
                    class="me-1 fw-bold">Status: </span><span class="badge bg-warning text-black fw-bold">
                    {{ $pesanan->statuspembayaran->sts_pembayaran}}</span></li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA;  font-size: 15px;" class="text-white">
              <tr>
                <th scope="col">Paket</th>
                <th scope="col">Berat</th>
                <th scope="col">Harga Paket</th>
                <th scope="col">layanan Khusus</th>
                <th scope="col">Jml L.Khusus</th>
                <th scope="col">Harga L.Khusus</th>

              </tr>
            </thead>
            <tbody style="font-size: 15px;">
                <tr>     
                    <td >{{ $pesanan->jenislayanan->jns_layanan}}</td>
                    <td >{{ $pesanan->berat }} Kg</td>
                    <td >Rp. {{ number_format($pesanan->jenislayanan->harga_layanan, 2, ',', '.') }}</td>
                    <td >{{ $pesanan->layananKhusus->lyn_khusus }}</td>
                    <td >{{ $pesanan->jml_layanankhusus }} pcs</td>
                    <td >Rp. {{ number_format($pesanan->layananKhusus->harga_khusus, 2, ',', '.') }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4"></th>
                    <td><b><i>Total</i></b></td>
                    <td><b><i>Rp. {{ number_format($pesanan->harga, 2, ',', '.') }}</i></b></td>
                </tr>
            </tfoot>
          </table>
        </div>
  
        <hr>

      </div>
    </div>


 
</body>
</html>
