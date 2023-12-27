@extends('layouts.template')
@section('content')
    <div class="row">
        <h2>Dashboard</h2>
        <p>Dashboard</p>
        @if (Session::get('failed'))
            <div class="alert alert-danger mt-2 mb-4">{{ Session::get('failed') }}</div>
        @endif
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
                <h4 class="card-title"> Jumlah Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }}</h4>
                <div class="card-body">
                    <h4><i class="fas fa-users"></i> {{ $totalLates }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-4">
                <h4 class="card-title"> Keterlambatan {{ App\Models\rayons::find($rayonIdLogin)->rayon }} Hari ini </h4>
                <h4 class="card-title"> {{ \Carbon\Carbon::now()->format('Y-m-d') }} </h4>
                <div class="card-body">
                    <h4><i class="fas fa-users"></i> {{ $todayLates }}</h4>
                </div>
            </div>
        </div>
    </div>
@endsection
