@extends('layouts.template')

@section('content')
    <h2>Tambah Data Siswa</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('siswa.index') }}">Data Siswa</a> / Tambah Data Siswa</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('siswa.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('siswa.store') }}" class="card mt-3 p-5" method="POST">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombels" class="form-control">
                    @foreach ($rombels as $rombel)
                        <option selected hidden disabled>Pilih Rombel</option>
                        <option value="{{ $rombel->id }}">{{ $rombel['rombel'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon" class="form-control">
                    @foreach ($rayons as $rayon)
                        <option selected hidden disabled>Pilih Rayon</option>
                        <option value="{{ $rayon->id }}">{{ $rayon['rayon'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
