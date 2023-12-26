@extends('layouts.template')

@section('content')
    <h2>Tambah Data Rombel</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a>/ <a href="{{ route('rombel.index') }}">Data Rombel</a> / Tambah Data Rombel</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('rombel.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('rombel.store')}}" class="card mt-3 p-5" method="POST">

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        @csrf
        <div class="mb-3 row">
            <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel') }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Kirim Data</button>
    </form>
@endsection
