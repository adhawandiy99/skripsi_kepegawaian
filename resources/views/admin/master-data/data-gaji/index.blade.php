@extends('layouts.new_app')
<title>SI-KMK | Daftar Gaji Pokok PNS - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title mb-3"><Strong>Data Gaji Pokok PNS</Strong></h3>
                        <a href="{{ route('gaji.create') }}" class="btn btn-success">Tambah Data</a>
                    </div>
                    <table class="table table-bordered table-sm">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Golongan</th>
                                <th>Masa Kerja</th>
                                <th>Gaji Pokok</th>
                                <th>Tahun Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                 $no = 1;
                            @endphp
                            @forelse ($gaji as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->golongan }}</td>
                                <td>{{ $item->masa_kerja }}</td>
                                <td>{{ $item->gaji_pokok }}</td>
                                <td>{{ $item->tahun }}</td>
                                <td>
                                   <a href="{{ route('gaji.edit', $item->id) }}" class="btn btn-warning btn-sm">  <i class="bx bx-edit"></i></a>
                                   <form onsubmit="return confirm('Yakin Mau Hapus Data??')" action="{{ route('gaji.destroy', $item->id) }}" method="POST" class="d-inline">
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
