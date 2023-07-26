@extends('layouts.new_app')
<title>SI-KMK | Usul kenaikan Gaji Berkala - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Usul Kenaikan Gaji Berkala</strong></h3>
                    </div>
                    <form action="{{ route('simpan.berkala') }}" method="POST" enctype="multipart/form-data">
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
                            <div class="mb-3 col-md-6 ">
                                <label for="email" class="form-label">Pangkat, Golongan</label>
                                <div class="d-flex">
                                    <input class="form-control" name="pangkat" value="{{ $user->pangkat }}" readonly/>
                                    <p>,</p>
                                    <input class="form-control"  name="golongan" value="{{ $user->golongan }}" readonly/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="gaji_lama" class="form-label">Gaji Lama</label>
                                <input class="form-control" type="text" id="gaji_lama" name="gaji_lama" value="{{ $user->gaji }}" readonly/>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="gaji_id" class="form-label">Gaji Baru</label>
                                <select name="gaji_id" class="form-select @error('gaji_id') is-invalid @enderror">
                                    <option value="" selected disabled>---Pilih Gaji Baru---</option>
                                          @foreach ($gaji as $gajis)
                                              @if (old('gaji_id') == $gajis->gaji_id)
                                              <option value="{{ $gajis->id }}">{{ $gajis->gaji_pokok }}</option>
                                              @else
                                              <option value="{{ $gajis->id }}">{{ $gajis->gaji_pokok }}</option>
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
                            <div class="mb-3 col-md-6">
                                <label for="mulai_tanggal" class="form-label">Mulai Tanggal</label>
                                <input class="form-control @error('mulai_tanggal') is-invalid @enderror" type="date" id="mulai_tanggal" name="mulai_tanggal" value="{{ old('mulai_tanggal') }}" />
                                @error('mulai_tanggal')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="naik_selanjutnya" class="form-label">Tanggal Kenaikan Selanjutnya</label>
                                <input class="form-control @error('naik_selanjutnya') is-invalid @enderror" type="date" id="naik_selanjutnya" name="naik_selanjutnya" value="{{ old('naik_selanjutnya') }}" />
                                @error('naik_selanjutnya')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="sk_berkala_terakhir">Fotocopy SK Berkala Terakhir</label>
                                    <input type="file" class="form-control col-4 @error('sk_berkala_terakhir') is-invalid @enderror" id="sk_berkala_terakhir" name="sk_berkala_terakhir" >
                                    @error('sk_berkala_terakhir')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sk_cpns">SK CPNS</label>
                                    <input type="file" class="form-control col-4 @error('sk_cpns') is-invalid @enderror" id="sk_cpns" name="sk_cpns" >
                                    @error('sk_cpns')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sk_naik_pangkat_akhir">SK Kenaikan Pangkat Terakhir</label>
                                    <input type="file" class="form-control col-4 " id="sk_naik_pangkat_akhir" name="sk_naik_pangkat_akhir" >
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sk_mangku_jabat">SK Pemangku Jabatan</label>
                                    <input type="file" class="form-control col-4 " id="sk_mangku_jabat" name="sk_mangku_jabat" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="tgl_usulan" class="form-label">Tanggal Diusulkan</label>
                                <input class="form-control @error('tgl_usulan') is-invalid @enderror" type="date" id="tgl_usulan" name="tgl_usulan" value="{{ old('tgl_usulan') }}" />
                                @error('tgl_usulan')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                             @enderror
                            </div>
                        </div>
                        <input name="idUser" type="hidden" value="{{$user->id}}">
                         <button type="submit" class="btn btn-success ">Simpan</button>
                         <a href="{{ route('index.berkala') }}" class="btn btn-warning">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
