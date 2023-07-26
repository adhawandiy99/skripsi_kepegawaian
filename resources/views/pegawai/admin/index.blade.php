@extends('layouts.new_app')
<title>SI-KMK | Daftar PNS - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title mb-3"><Strong>Daftar Pegawai Negeri Sipil Satpol PP & Damkar Tapin</Strong></h3>
                    <div class="form-group float-right">
                        <a href="{{ route('print.pns') }}" class="btn btn-success btn-md">Laporan Daftar PNS</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>NIP</th>
                                <th>NAMA PNS</th>
                                <th>PANGKAT/GOLONGAN</th>
                                <th>JABATAN</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                            @endphp
                            @forelse ($user as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->kepegawaian_pns->pangkat }} - {{ $item->kepegawaian_pns->golongan }}</td>
                                <td>{{ $item->kepegawaian_pns->jabatan }}</td>
                                <td>
                                    <a href="{{ route('pegawai.show', $item->id) }}" class="btn btn-success btn-sm"> <i class="bx bx-search"></i></a>
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
