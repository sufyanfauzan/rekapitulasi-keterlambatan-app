@extends('layouts.template')

@section('content')
<h2>Detail Data Keterlambatan</h2>
<p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('terlambat.index') }}">Data Keterlambatan</a> / Detail Data Keterlambatan</p>
<br>
<h5>{{ $student->nis }} | {{ $student->name }} | {{ $student->rombels->rombel }} | {{ $student->rayons->rayon }}</h5>
<div class="row mt-5">
    @foreach ($lates as $index => $late)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body custom-card-body">
                    <h5 class="card-title">Keterlambatan Ke-{{ $index + 1 }}</h5>
                    <div class="p-5">
                        <p class="card-text">{{ $late->date_time_late }}</p>
                        <p class="card-text">{{ $late->information }}</p>
                        <img src="{{ URL('storage/images/' . $late->bukti) }}" alt="Bukti Keterlambatan" class="img-fluid" width="150">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
