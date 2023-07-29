@extends('layouts.user')

@section('content')
    <div id="demo" class="carousel slide mb-4" data-bs-ride="carousel" >

      <!-- Indicators/dots -->
      <div class="carousel-indicators">
        @foreach($list as $key => $l)
          <button type="button" data-bs-target="#demo" data-bs-slide-to="{{ $key }}" class="{{ $key?'':'active' }}"></button>
        @endforeach
      </div>
      
      <!-- The slideshow/carousel -->
      <div class="carousel-inner">
        @foreach($list as $key => $l)

          <?php
            $file = isset($l->foto_landing_page)?$l->foto_landing_page:'new';
          ?>
          
        <div class="carousel-item {{ $key?'':'active' }}" data-bs-interval="1000">
          @if (file_exists(public_path().'/storage/uploads/landing_page/'.$file))
            <img src="/storage/uploads/landing_page/{{ $file }}" class="d-block" style="width:100%">
          @else
            <img src="/placeholder.png" class="d-block" style="width:100%">
          @endif
          
          <div class="carousel-caption">
            <h3 class="bg-primary">{{ $l->tittle }}</h3>
            <p class="bg-secondary">{{ $l->deskripsi }}</p>
          </div>
        </div>
        @endforeach
      </div>
      
      <!-- Left and right controls/icons -->
      <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
      </button>
    </div>

    <div class="card mb-4">
        <div class="card-body">
          <div class="card-header">
            <h3 class="card-title text-center"><strong class="fs-1">VISI</strong></h3>
          </div>
            <p class="fs-2">Terwujudnya Polisi Pamong Praja yang Profesional dan Berwibawa dalam pelaksanaan tugas, menjadi pengayom dan pelayan masyarakat, serta Penegak Perda yang tangguh dan mumpuni.</p>
          </div>
    </div>
    <div class="card">
        <div class="card-header">
          <h3 class="card-title text-center"><strong class="fs-1">MISI</strong></h3>
        </div>
        <div class="card-body">

          <div class="row">
            <div class="col-md-1 spinner-grow mb-2"></div>
            <div class="col-md-11 fs-4">Meningkatkan profesionalisme sebagai aparat Pemerintah daerah agar semakin menumbuhkan kepercayaan masyarakat;</div>
          </div>
          <div class="row">
            <div class="col-md-1 spinner-grow text-dark mb-2"></div>
            <div class="col-md-11 fs-4">Menegakkan supremasi hukum demi terciptanya kebenaran dan keadilan;</div>
          </div>
          <div class="row">
            <div class="col-md-1 spinner-grow mb-2"></div>
            <div class="col-md-11 fs-4">Menciptakan kondisi wilayah Kabupaten Purbalingga yang kondusif, guna mendukung lancarnya pembangunan daerah;</div>
          </div>
          <div class="row">
            <div class="col-md-1 spinner-grow text-dark mb-2"></div>
            <div class="col-md-11 fs-4">Membangun jiwa kepamongprajaan, agar dapat menjadi abdi masyarakat yang berwibawa, bertanggung jawab dan disiplin dalam melaksanakan tugas, pengayom dan pelindung masyarakat;</div>
          </div>
          <div class="row">
            <div class="col-md-1 spinner-grow mb-2"></div>
            <div class="col-md-11 fs-4">Meningkatkan koordinasi dengan instansi terkait dalam rangka terwujudnya keberhasilan pelaksanaan tugas.</div>
          </div>
        </div>
    </div>
@endsection