@extends('layouts.template')
@section('content')
    <h1>Edit Data Keterlambatan</h1>
    <p>Home / Terlambat / Edit Data Keterlambatan</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="#">Kembali</a></button>
    </div>
    <form action="{{ route('terlambat.update', $lates['id']) }}" method="post" class="card mt-3 p-5" enctype="multipart/form-data">
        {{-- kalau ada error validasi, akan di tampilkan disini --}}
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        {{-- kalau kedeteksi ada with seession namanya  --}}
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        {{-- token syarat kirim data (agar sistem membaca bahawa data ini berasal dari sumber yang sah) wajib buat kirim data ke database --}}
        @csrf
        @method('PATCH')
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <select disabled class="form-control" id="student_id" name="student_id">
                    <option hidden disabled>Pilih nama</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}" {{ $lates['student_id'] == $student->id ? 'selected' : '' }}>
                            {{ $student->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label @error('date_time_late') is-innvalid @enderror">Waktu
                Terlambat</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late"
                    value="{{ $lates['date_time_late'] }}">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information"
                class="col-sm-2 col-form-label @error('information') is-innvalid @enderror">information</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information"
                    value="{{ $lates['information'] }}">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label @error('bukti') is-invalid @enderror">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti" value="">
                @error('bukti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <img src="{{ asset('storage/images/' . $lates['bukti']) }}" alt="Gambar Lama" width="100">
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
