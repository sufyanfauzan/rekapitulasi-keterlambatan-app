@extends('layouts.template')

@section('content')
    <h2>Edit Data User</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / <a href="{{ route('user.index') }}">Data User</a> / Edit Data User</p>
    <div class="d-flex justify-content-end">
        <a class="btn btn-secondary me-2" href="{{ route('user.index') }}">Kembali</a></button>
    </div>
    <form action="{{ route('user.update', $user['id']) }}" method="POST" class="card mt-3 p-5">
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
            <label for="name" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $user['name'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="email" value="{{ $user['email'] }}">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Role</label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-control">
                    <option selected hidden disabled>Tipe Role</option>
                    <option value="admin" {{ $user['role'] == 'admin' ? 'selected' : '' }}>admin</option>
                    <option value="ps" {{ $user['role'] == 'ps' ? 'selected' : '' }}>Pembimbing Siswa</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="price" class="col-sm-2 col-form-label">Ganti Password</label>
            <div class="col-sm-10">
                <input type="password" name="pass" class="form-control" id="pass">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
    </form>
@endsection
