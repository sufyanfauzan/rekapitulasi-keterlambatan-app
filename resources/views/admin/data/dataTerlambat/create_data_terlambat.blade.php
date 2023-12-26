@extends('layouts.template')

@section('content')
    <h2>Tambah Data Keterlambatan</h2>
    <p>Home / Data Keterlambatan / Tambah Data Keterlambatan</p>
    <form action="{{ route('terlambat.store') }}" class="card mt-3 p-5" method="POST" enctype="multipart/form-data">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label @error('student_id') is-invalid @enderror">Siswa</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-control">
                    <option selected hidden disabled>Pilih Siswa</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>        

        <div class="mb-3 row">
            <label for="date_time_late"
                class="col-sm-2 col-form-label @error('date_time_late') is-invalid @enderror">Waktu</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late"
                    value="{{ old('date_time_late') }}">
                @error('date_time_late')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information"
                class="col-sm-2 col-form-label @error('information') is-invalid @enderror">Information</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information"
                    value="{{ old('information') }}">
                @error('information')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label @error('bukti') is-invalid @enderror">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti" name="bukti" value="{{ old('bukti') }}">
                @error('bukti')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
