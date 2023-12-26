@extends('layouts.template')

@section('content')
    <h2>Edit Data Rombel</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('rombel.index') }}">Data Rombel</a> / Edit Data Rombel</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('rombel.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('rombel.update', $rombels['id']) }}" method="POST" class="card p-5 mt-3">
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
            <label for="rombel" class="col-sm-2 col-form-label">Rombel</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombels['rombel'] }}">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
