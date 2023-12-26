@extends('layouts.template')

@section('content')
    <h2>Tambah Data Rayon</h2>
    <p>Home / Data Rayon / Tambah Data Rayon</p>
    <form action="{{ route('rayon.store')}}" class="card mt-3 p-5" method="POST">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-invalid @enderror">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
                @error('rayon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="user_id" class="col-sm-2 col-form-label @error('user_id') is-invalid @enderror">PS</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option selected hidden disabled>Pilih Pembimbing Siswa</option>
                        <option value="{{ $user->id }}">{{ $user['name'] }}</option>
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
