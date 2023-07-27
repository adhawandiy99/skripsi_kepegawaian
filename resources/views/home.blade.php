@extends('layouts.new_app')
@section('css')
    <link rel="stylesheet" href="/sneat/libs/toastr/toastr.css" />
@endsection
@section('content')
<div class="container">
    <div class="card mb-3">
        <div class="card-header"><h5>{{ __('Home') }}</h5></div>
        <div class="card-body">
            <p class="mb-0">
                <h5>Di Sistem Informasi Kepegawaian dan Manajemen Kearsipan (SI-KMK)</h5>
                <h5>Dinas Satuan Polisi Pamong Praja dan Damkar Tapin</h5>
              </p>
        </div>
    </div>
    <div class="alert alert-info my-4">
      <strong><i class="bx bxs-bell bx-tada"></i></strong> Ferdy - nip:1900000 telah submit kenaikan pangkat pada tanggal 28-juli-2023. <strong><a class="alert-link" href="https://boxicons.com/" target="_blank" rel="noopener noreferrer">Silahkan klik menuju <a href="/home">Approval</a></strong>.
    </div>

</div>
@endsection
@section('js')
    <script src="/sneat/libs/toastr/toastr.js"></script>
@endsection