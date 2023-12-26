@extends('layouts.template')

@section('content')
    <h2>Data Rayon</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / Data Rayon</p>
    <br>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    {{-- fitur add, search --}}
    <div class="d-md-flex justify-content-start align-items-center">
        <a href="{{ route('rayon.create') }}" class="btn btn-primary mb-2 mb-md-0"><i class="fas fa-plus"></i> Tambah Data Rayon</a>
    </div>
    <div class="d-md-flex justify-content-between align-items-center mt-3">
        <form action="{{ route('rayon.index') }}" method="get" class="d-flex">
            <select name="perPage" class="form-control text-center" id="perPage" onchange="this.form.submit()" style="width: 50px">
                <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
            </select>
            <div class="form-control form-control text-center">
                entries per page
            </div>
        </form>
        <form action="{{ route('rayon.index') }}" method="get" class="d-flex mt-3">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari Rayon" value="{{ $search }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
            <a href="{{ route('rayon.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i></a>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3 text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pembimbing Siswa</th>
                    <th>Rayon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($rayons as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->user ? $item->user->name : 'Belum Ada Pembimbing' }}</td>
                        <td>{{ $item['rayon'] }}</td>
                        <td class="d-flex">
                            <a href="{{ route('rayon.edit', $item['id']) }}" class="btn btn-primary me-2"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('rayon.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data?');"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
