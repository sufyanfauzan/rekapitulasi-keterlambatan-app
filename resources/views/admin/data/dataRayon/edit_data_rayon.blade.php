@extends('layouts.template')

@section('content')
    <h2>Edit Data Rayon</h2>
    <p>Home / Data Rayon / Edit Data Rayon</p>
    <form action="{{ route('rayon.update', $rayons['id']) }}" method="POST" class="card p-5">
        @csrf
        @method('PATCH')

        @if ($errors->any())
            <ul class="alert alert-danger p-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="rayon" class="col-sm-2 col-form-label @error('rayon') is-invalid @enderror"">Rayon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rayon" name="rayon" value="{{ $rayons['rayon'] }}">
                @error('rayon')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label @error('role') is-invalid @enderror">PS</label>
            <div class="col-sm-10">
                <select name="user_id" id="user_id" class="form-control">
                    <option hidden disabled selected>Pilih Pembimbing Siswa</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $user->id == $rayons->user_id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
