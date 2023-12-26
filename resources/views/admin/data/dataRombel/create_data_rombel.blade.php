@extends('layouts.template')

@section('content')
    <h2>Tambah Data Rombel</h2>
    <p>Home / Data rombel / Tambah Data Rombel</p>
    <form action="{{ route('rombel.store')}}" class="card mt-3 p-5" method="POST">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        {{-- token syarat untuk mengirim data (sistem membaca bahwa data ini berasal dari sumber yang sah) --}}
        @csrf
        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label @error('rombel') is-invalid @enderror">Rombel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel') }}">
                @error('rombel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
