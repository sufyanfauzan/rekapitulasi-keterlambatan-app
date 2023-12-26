@extends('layouts.template')
@section('content')
    <div class="row">
        <h2>Dashboard</h2>
        <p>Dashboard</p>
        @if (Session::get('failed'))
            <div class="alert alert-danger mt-2 mb-4">{{ Session::get('failed') }}</div>
        @endif
        <div class="col-md-5">
            <div class="card p-4">
                <h4 class="card-title"> Peserta Didik</h4>
                <div class="card-body">
                    <h4><i class="fas fa-users"></i> {{ $students }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-4">
                <h4 class="card-title"> Administrator</h4>
                <div class="card-body">
                    <h4><i class="fas fa-user"></i> {{ $userAdmin }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-4">
                <h4 class="card-title"> Pembimbing Siswa</h4>
                <div class="card-body">
                    <h4><i class="fas fa-user-tie"></i> {{ $userPs }}</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title"> Rombel</h4>
                <div class="card-body">
                    <h4><i class="fas fa-bookmark"></i> {{ $rombels }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title"> Rayon</h4>
                <div class="card-body">
                    <h4><i class="fas fa-bookmark"></i> {{ $rayons }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
