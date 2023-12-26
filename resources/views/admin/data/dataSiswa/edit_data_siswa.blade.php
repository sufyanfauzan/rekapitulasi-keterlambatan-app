@extends('layouts.template')

@section('content')
    <h2>Edit Data Siswa</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('siswa.index') }}">Data Siswa</a> / Edit Data Siswa</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('siswa.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('siswa.update', $students['id']) }}" class="card mt-3 p-5" method="POST">
        @method('PATCH')
        @csrf

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">NIS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel" class="form-control">
                    <option disabled>Pilih Rombel</option>
                    @foreach ($rombels as $rombel)
                        <option value="{{ $rombel->id }}" {{ $rombel['id'] == $students['rombel_id'] ? 'selected' : '' }}>
                            {{ $rombel['rombel'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon" class="form-control">
                    @foreach ($rayons as $rayon)
                        <option value="{{ $rayon->id }}" {{ $rayon['id'] == $students['rayon_id'] ? 'selected' : '' }}>
                            {{ $rayon['rayon'] }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
@endsection
