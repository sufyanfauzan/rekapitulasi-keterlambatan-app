@extends('layouts.template')

@section('content')
    <h2>Tambah Data Siswa</h2>
    <p>Home / Data Siswa / Tambah Data Siswa</p>
    <form action="{{ route('siswa.store')}}" class="card mt-3 p-5" method="POST">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label @error('nis') is-invalid @enderror">Nis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
                @error('nis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label @error('user_id') is-invalid @enderror">Rombel</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombels" class="form-control">
                    @foreach ($rombels as $rombel)
                        <option selected hidden disabled>Pilih Rombel</option>
                        <option value="{{ $rombel->id }}">{{ $rombel['rombel'] }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label @error('user_id') is-invalid @enderror">Rayon</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon" class="form-control">
                    @foreach ($rayons as $rayon)
                        <option selected hidden disabled>Pilih Rayon</option>
                        <option value="{{ $rayon->id }}">{{ $rayon['rayon'] }}</option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
