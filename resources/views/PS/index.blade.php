{{-- @extends('layouts.template')
@section('content')
    <div class="container">
        <h1>Data Siswa</h1>
        <p>Total Peserta Didik: {{ $totalStudents }}</p>
        <p>Total Keterlambatan: {{ $totalLates }}</p>
        <p>Total Keterlambatan Hari Ini: {{ $todayLates }}</p>
        <p>Rayon: {{ App\Models\rayons::find($rayonIdLogin)->rayon }}</p>
    </div>
@endsection


 --}}

@extends('layouts.template')
@section('content')
    <div class="row">
        <h2>Dashboard</h2>
        <p>Home / Dashboard</p>
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title"> Peserta Didik Rayon {{ App\Models\rayons::find($rayonIdLogin)->rayon }}</h4>
                <div class="card-body">
                    <h4><i class="fas fa-users"></i> {{ $totalStudents }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title"> Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }} Hari ini </h4>
                <div class="card-body">
                    <h4><i class="fas fa-users"></i> {{ $todayLates }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
