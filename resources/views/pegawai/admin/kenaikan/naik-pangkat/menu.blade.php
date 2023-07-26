@extends('layouts.new_app')
<title>SI-KMK | Menu Data Kenaikan Pangkat PNS - Satpol PP & Damkar Tapin</title>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h5>{{ __('Menu Kenaikan Pangkat PNS') }}</h5>
                </div>
                <div class="card-body">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Kenaikan Pangkat </h5>
                              <p class="card-text"><strong>Jabatan Reguler Eselon Struktural.</strong> </p>
                              <a href="{{ route('index.struktural') }}" class="btn btn-primary">Masuk</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Kenaikan Pangkat </h5>
                              <p class="card-text"><strong>Jabatan Pelaksana/Staf.</strong></p>
                              <a href="{{ route('index.ps') }}" class="btn btn-Success">Masuk</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Kenaikan Pangkat</h5>
                              <p class="card-text"><strong>Jabatan Pelaksana/Staf Penyesuaian Ijazah.</strong></p>
                              <a href="{{ Route('index.psi') }}" class="btn btn-warning">Masuk</a>
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title">Kenaikan Pangkat</h5>
                              <p class="card-text"><strong>Jabatan Fungsional Tertentu.</strong></p>
                              <a href="{{ route('index.ft') }}" class="btn btn-info">Masuk</a>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
