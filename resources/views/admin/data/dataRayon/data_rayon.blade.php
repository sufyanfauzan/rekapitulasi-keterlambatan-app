@extends('layouts.template')

@section('content')
    <h2>Data Rayon</h2>
    <p>Home / Data Rayon</p>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <a href="{{ route('rayon.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Rayon</i></a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
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
                @foreach ($rayons as $item)
                    <tr>
                        <td>{{ ($rayons->currentpage() - 1) * $rayons->perpage() + $loop->index + 1 }}</td>
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
    <div class="d-flex justify-content-end">
        @if ($rayons->count())
            {{ $rayons->links() }}
        @endif
    </div>
@endsection
