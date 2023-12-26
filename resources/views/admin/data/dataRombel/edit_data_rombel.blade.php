@extends('layouts.template')

@section('content')
    <h2>Edit Data Rombel</h2>
    <p>Home / Data Rombel / Edit Data Rombel</p>
    <form action="{{ route('rombel.update', $rombels['id']) }}" method="POST" class="card p-5">
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
            <label for="rombel" class="col-sm-2 col-form-label @error('rombel') is-invalid @enderror"">Nama Pengguna :
            </label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombels['rombel'] }}">
                @error('rombel')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
