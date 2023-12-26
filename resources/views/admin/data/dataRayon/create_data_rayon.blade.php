@extends('layouts.template')

@section('content')
    <h2>Tambah Data Rayon</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('rayon.index') }}">Data Rayon</a> / Tambah Data Rayon</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('rayon.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('rayon.store') }}" class="card mt-3 p-5" method="POST">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @csrf
        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">PS</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option selected hidden disabled>Pilih Pembimbing Siswa</option>
                        <option value="{{ $user->id }}">{{ $user['name'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
