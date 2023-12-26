@extends('layouts.template')

@section('content')
    <h2>Edit Data Siswa</h2>
    <p>Home / Data Siswa / Edit Data Siswa</p>
    <form action="{{ route('siswa.update', $students['id']) }}" class="card mt-3 p-5" method="POST">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @method('PATCH')
        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label @error('nis') is-invalid @enderror">NIS</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $students['nis'] }}">
                @error('nis')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $students['name'] }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label @error('rombel_id') is-invalid @enderror">Rombel</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel" class="form-control">
                    <option disabled>Pilih Rombel</option>
                    @foreach ($rombels as $rombel)
                        <option value="{{ $rombel->id }}" {{ $rombel['id'] == $students['rombel_id'] ? 'selected' : '' }}>
                            {{ $rombel['rombel'] }}
                        </option>
                    @endforeach
                </select>
                
                @error('rombel_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label @error('rayon_id') is-invalid @enderror">Rayon</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon" class="form-control">
                    @foreach ($rayons as $rayon)
                        <option value="{{ $rayon->id }}" {{ $rayon['id'] == $students['rayon_id'] ? 'selected' : '' }}>
                            {{ $rayon['rayon'] }}
                        </option>
                    @endforeach
                </select>
                @error('rayon_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
@endsection
