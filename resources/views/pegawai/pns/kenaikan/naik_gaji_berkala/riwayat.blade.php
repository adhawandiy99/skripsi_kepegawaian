@extends('layouts.new_app')
<title>APK-KMK | Data Kenaikan Gaji Berkala PNS - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title mb-3"><Strong>Data Kenaikan Gaji Berkala PNS</Strong></h3>
                        <a href="{{ route('tambah.berkala') }}" class="btn btn-success">Tambah Data</a>
                    </div>
                    <div class="card-header">
                        <h4><strong>Riwayat Kenaikan Gaji Berkala PNS : {{ auth()->user()->name }} - {{ auth()->user()->nip }}</strong></h4>
                    </div>
                    <table class="table table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Gaji Lama</th>
                                <th>Gaji Baru</th>
                                <th>Tanggal Diusulkan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                            @endphp
                            @forelse ($naikBerkala as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user_pegawai->nip }}</td>
                                <td>{{ $item->user_pegawai->name }}</td>
                                <td>{{ $item->user_pegawai->kepegawaian_pns->gaji }}</td>
                                <td>{{ $item->gaji->gaji_pokok }}</td>
                                <td>{{ $item->tgl_usulan }}</td>
                                <td>{{ $item->ket }}</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm"> <i class="bx bx-search"></i></a>
                                   <a href="" class="btn btn-warning btn-sm">  <i class="bx bx-edit"></i></a>
                                   <form onsubmit="return confirm('Yakin Mau Hapus Data??')" action="" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit"><i class="bx bx-trash"></i></button>
                                  </form>
                                </td>
                            </tr>
                            @empty
                            <td colspan="4">Data Tidak Ada</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
