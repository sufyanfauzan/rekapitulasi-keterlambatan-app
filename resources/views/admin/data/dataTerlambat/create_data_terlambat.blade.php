@extends('layouts.template')

@section('content')
    <h2>Tambah Data Keterlambatan</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('terlambat.index') }}">Data Keterlambatan</a> /
        Tambah Data Keterlambatan</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('terlambat.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('terlambat.store') }}" class="card mt-3 p-5" method="POST" enctype="multipart/form-data">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @csrf
        <div class="mb-3 row">
            <label for="student_id" class="col-sm-2 col-form-label">Siswa</label>
            <div class="col-sm-10">
                <select name="student_id" id="student_id" class="form-control">
                    <option selected hidden disabled>Pilih Siswa</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date_time_late" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_late" name="date_time_late"
                    value="{{ old('date_time_late') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Informasi</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information"
                    value="{{ old('information') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Bukti</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="bukti_create" name="bukti" value="{{ old('bukti') }}">
                <br>
                <img id="previewImage" src="" alt="" style="height: 200px; width: 200px; object-fit: cover; display: none;">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection

@push('script')
    <script src="{{ URL('assets/js/set_image_form.js'); }}"></script>
@endpush
