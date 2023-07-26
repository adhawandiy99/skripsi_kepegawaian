@extends('layouts.new_app')
<title>SI-KMK | Riwayat Pendidikan - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-3"><Strong>Riwayat Pendidikan</Strong></h3>
                    <div class="button-group">
                        <a href="{{route('tambah.pend')}}" class="btn btn-info">Tambah Data Riwayat</a>
                        <a href="{{ route('show.pegawai') }}" class="btn btn-danger">Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover table-sm">
                        <thead class="text-center table-info">
                            <tr>
                                <th>No</th>
                                <th>NO Ijazah</th>
                                <th>Tanggal Ijazah</th>
                                <th>Tingkat Pendidikan</th>
                                <th>Lembaga Pendidikan</th>
                                <th>Jurusan</th>
                                <th>Kota</th>
                                <th>Tahun lulus</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                            @endphp
                            @forelse ($user->riwayat_pendidikan as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->no_ijazah }}</td>
                                <td>{{ $item->tgl_ijazah }}</td>
                                <td>{{ $item->tingkat_pendidikan }}</td>
                                <td>{{ $item->lembaga_pendidikan }}</td>
                                <td>{{ $item->jurusan }}</td>
                                <td>{{ $item->kota }}</td>
                                <td>{{ $item->tahun_lulus }}</td>
                                <td>
                                   <a href="{{ route('pendidikan.edit', $item->id_pendidikan) }}" class="btn btn-warning btn-sm">  <i class="bx bx-edit"></i></a>
                                   <form onsubmit="return confirm('Yakin Mau Hapus Data??')" action="{{ route('pendidikan.hapus', $item->id_pendidikan) }}" method="POST" class="d-inline">
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
