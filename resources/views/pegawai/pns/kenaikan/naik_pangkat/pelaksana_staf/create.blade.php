@extends('layouts.new_app')
<title>SI-KMK | Usul kenaikan Pangkat PNS Jabatan Pelaksana/Staf - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Usul Kenaikan Pangkat PNS Jabatan Pelaksana/Staf</strong></h3>
                    <p>Silahkan Isi Data yang diperlukan</p>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                         <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nip" class="form-label">NIP</label>
                                <input class="form-control " type="text" id="nip" name="nip" value="{{ $user->nip }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Nama PNS</label>
                                <input class="form-control " type="text" id="name" name="name" value="{{ $user->name }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6 ">
                                <label for="email" class="form-label">Tempat, Tanggal lahir</label>
                                <div class="d-flex">
                                    <input class="form-control" name="t_lahir" value="{{ $user->t_lahir }}" readonly/>
                                    <p>,</p>
                                    <input class="form-control" type="date"  name="tgl_lahir" value="{{ $user->tgl_lahir }}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <input class="form-control " type="text" id="jabatan" name="jabatan" value="{{ $user->jabatan }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="golongan" class="form-label">Golongan</label>
                                <input class="form-control " type="text" id="golongan" name="golongan" value="{{ $user->golongan }}" readonly/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="pangkat_lama" class="form-label text-primary">Pangkat Lama</label>
                                <input class="form-control" type="text" id="pangkat_lama" name="pangkat_lama" value="{{ $user->pangkat }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gaji_id" class="form-label text-info"><span class="text-danger">*</span>Pangkat Baru</label>
                                <select name="pangkat_id" class="form-select @error('pangkat_id') is-invalid @enderror">
                                    <option value="" selected disabled>---Pilih Pangkat Baru---</option>
                                          @foreach ($pangkat as $pang)
                                              @if (old('pangkat_id') == $pang->pangkat_id)
                                              <option value="{{ $pang->id_pangkat }}">{{ $pang->nama_pangkat }}</option>
                                              @else
                                              <option value="{{ $pang->id_pangkat }}">{{ $pang->nama_pangkat }}</option>
                                              @endif
                                          @endforeach
                                </select>
                                @error('gaji_id')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                 @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="masa_kerja" class="form-label">Masa Kerja</label>
                                <input class="form-control" type="text" id="masa_kerja" name="masa_kerja" value="{{ $user->masa_kerja }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6 ">
                                <label for="mulai_tanggal" class="form-label"><span class="text-danger">*</span>Mulai Tanggal</label>
                                <input class="form-control @error('mulai_tanggal') is-invalid @enderror" type="date" id="mulai_tanggal" name="mulai_tanggal" value="{{ old('mulai_tanggal') }}" />
                                @error('mulai_tanggal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>

                            <div class="mb-3 col-md-6 mb-4">
                                <label for="naik_selanjutnya" class="form-label"><span class="text-danger">*</span>Tanggal Kenaikan Selanjutnya</label>
                                <input class="form-control @error('naik_selanjutnya') is-invalid @enderror" type="date" id="naik_selanjutnya" name="naik_selanjutnya" value="{{ old('naik_selanjutnya') }}" />
                                @error('naik_selanjutnya')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                        </div>
                        <hr>
                        <p><h5><strong>Surat Pengantar :</strong></h5></p>
                        <p><strong>Berikut adalah berkas-berkas yang dilampirkan untuk kenaikan pangkat,<br>Silahkan buat berkas-berkas dibawah ini kedalam bentuk File ZIP / RAR :</strong></p>
                        <div class="row mb-4">
                            @include('pegawai\pns\kenaikan\naik_pangkat\pelaksana_staf\kelengkapan')
                        </div>
                           <hr>
                            <p><h5><strong>Pencatuman Gelar Pendidikan bagi yang memiliki ijazah baru dan belum tercantum di SK Kenaikan pangkat Terakhir :</strong></h5></p>
                            <p><strong>Berikut adalah berkas-berkas yang dilampirkan untuk kenaikan pangkat,<br>Silahkan buat berkas-berkas dibawah ini kedalam bentuk File ZIP / RAR :</strong></p>
                        <div class="row mb-4">
                            @include('pegawai\pns\kenaikan\naik_pangkat\pelaksana_staf\kelengkapan_pend')
                        </div>
                            <div class="mb-3 col-md-6">
                                <p>Upload Kedua File ZIP atau RAR Tersebut kedalam Google Drive, lalu masukkan Link Google Drive Tersebut Kedalam Form Input (Pastikan Link Google Drive dalam status "Dapat Diakses Semua")</p>
                                <label for="link"><span class="text-danger">*</span><strong>Masukkan Link Google Drive <i class='bx bxl-google-cloud'></i></strong></label>
                                    <input type="text" class="form-control col-4 @error('link') is-invalid @enderror" id="link" name="link" >
                                    @error('link')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tgl_usulan" class="form-label"><span class="text-danger">*</span>Tanggal Diusulkan</label>
                                <input class="form-control @error('tgl_usulan') is-invalid @enderror" type="date" id="tgl_usulan" name="tgl_usulan" value="{{ old('tgl_usulan') }}" />
                                @error('tgl_usulan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                        </div>
                         <button type="submit" class="btn btn-info ">Simpan</button>
                         <a href="{{ route('menu.pangkat.pestaf') }}" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
