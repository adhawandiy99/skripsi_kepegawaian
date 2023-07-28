@extends('layouts.new_app')
<title>APK-KMK | Data Kenaikan Pangkat PNS Jabatan Pelaksana/Staf - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-3"><Strong>Data Kenaikan Pangkat PNS Jabatan Pelaksana/Staf</Strong></h3>
                    <h5>Riwayat Pangkat PNS Jabatan Pelaksana/Staf : {{ auth()->user()->name }} - {{ auth()->user()->nip }}</h5>
                    <a href="{{ route('tambah.pangkat.pestaf',['new']) }}" class="btn btn-warning">Tambah Data</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Pangkat Lama</th>
                                <th>Pangkat baru</th>
                                <th>Tanggal Diusulkan</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                            @endphp
                            @forelse ($naikPangkat as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user_pegawai->nip }}</td>
                                <td>{{ $item->user_pegawai->name }}</td>
                                <td>{{ isset($item->user_pegawai->kepegawaian_pns->pangkat) ? $item->user_pegawai->kepegawaian_pns->pangkat: '' }}</td>
                                <td>{{ isset($item->pangkat_pns->nama_pangkat) ? $item->pangkat_pns->nama_pangkat: ''}}</td>
                                <td>{{ $item->tgl_usulan }}</td>
                                <td>{{ $item->ket }}</td>
                                <td>
                                    <a href="" class="btn btn-success btn-sm"> <i class="bx bx-search"></i></a>
                                   <a href="{{ route('tambah.pangkat.pestaf',[$item->id]) }}" class="btn btn-warning btn-sm">  <i class="bx bx-edit"></i></a>
                                   <form onsubmit="return confirm('Yakin Mau Hapus Data??')" action="/PNS/delete-usulan-kenaikan" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" name="id" value="{{$item->id}}"><i class="bx bx-trash"></i></button>
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
