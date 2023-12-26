@extends('layouts.template')

@section('content')
    <h2>Data Siswa</h2>
    <p>Home / Data Siswa</p>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <a href="{{ route('siswa.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Siswa</i></a>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nis</th>
                    <th>Nama</th>
                    <th>Rombel</th>
                    <th>Rayon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($students as $key => $item)
                    <tr>
                        {{-- <td>{{ ($rombels->currentpage() - 1) * $rombels->perpage() + $loop->index + 1 }}</td> --}}
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item['nis'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item->rombels->rombel }}</td>
                        <td>{{ $item->rayons->rayon }}</td>
                        <td class="d-flex">
                            <a href="{{ route('siswa.edit', $item['id']) }}" class="btn btn-primary me-2"><i
                                    class="fas fa-edit"></i></a>
                            <form action="{{ route('rombel.delete', $item['id']) }}" method="post">
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
    {{-- <div class="d-flex justify-content-end">
        @if ($rombels->count())
            {{ $rombels->links() }}
        @endif
    </div> --}}
@endsection
