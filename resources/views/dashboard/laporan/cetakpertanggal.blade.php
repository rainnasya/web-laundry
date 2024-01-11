<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <title>Laporan Pemasukan</title>
  </head>

<div class="row">
    <div class="col text-center">
        <h5 style="font-size: 20px;">LOVA LAUNDRY</h5>
        <h6 style="font-size: 17px;">Jasa Cuci Kiloan Berkualitas</h6>
        <h6 style="font-size: 17px;">Bersih - Rapi - Wangi</h6>
    </div>
</div>

<hr><br> 
<h6>Total Pemasukan: Rp. {{ number_format($totalPemasukan, 2, ',', '.')}}</h6><br>
<div class="row">
<table class="table table-striped table-borderless">
<thead style="background-color:#84B0CA; font-size: 15px;" class="text-dark">
    <tr>
        <th >No</th>
        <th >Kd pesanan</th>
        <th >Tgl Pesanan</th>
        <th >Pelanggan</th>
        <th >Paket</th>
        <th >Berat</th>
        <th >L.Khusus</th>
        <th >Jml L.Khusus</th>
        <th >Total Harga</th>
    </tr>
  </thead>
  <tbody style="font-size: 15px;">
    @foreach ($pesanans as $pesanan)
    <tr>
        <td >{{ $loop->iteration }}</td>
        <td >{{ $pesanan->kd_pesanan}}</td>
        <td >{{ $pesanan->tgl_pesanan }} </td>
        <td >{{ $pesanan->pelanggan->nama_pelanggan}}</td>
        <td >{{ $pesanan->jenislayanan->jns_layanan }}</td>
        <td >{{ $pesanan->berat }} Kg</td>
        <td >{{ $pesanan->layananKhusus->lyn_khusus }}</td>
        <td >{{ $pesanan->jml_layanankhusus }} pcs</td>
        <td >Rp. {{ number_format($pesanan->harga, 2, ',', '.') }}</td>
    </tr>
    @endforeach   
        
   </tbody>
   
</table>
</div>

</body>
</html>
