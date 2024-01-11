@extends('layout.main')
@section('container')

    <section class="section my-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card py-4 px-4">
                    <div class="row">
                        <div class="pb-2 mb-3 border-bottom text-center">
                            <h2 class="mt-2 text-center">FORM DATA PELANGGAN</h2>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h4 class="card-title">Profile</h4>
                                    <div class="card-tools"></div>
                                </div>
                                <div class="card-body mt-3">
                                    <div class="text-center">
                                      <img src="{{ asset('profil/' . $pelanggans->foto_profil) }}" width="210px;" height="220" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Detail Pelanggan</h3>
                                    <div class="card-tools"></div>
                                </div>
                                <div class="card-body mt-2">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b>Username</b></td>
                                                <td>:</td>
                                                <td>{{ $pelanggans->user->username}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Nama Pelanggan</b></td>
                                                <td>:</td>
                                                <td>{{ $pelanggans->nama_pelanggan}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email Pelanggan</b></td>
                                                <td>:</td>
                                                <td>{{ $pelanggans->user->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Alamat</b></td>
                                                <td>:</td>
                                                <td>{{ $pelanggans->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Telepon</b></td>
                                                <td>:</td>
                                                <td>{{ $pelanggans->telp }}</td>
                                            </tr>  
                                        </tbody>
                                    </table>
                                </div>
  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection