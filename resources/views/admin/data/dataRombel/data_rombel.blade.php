@extends('layouts.template')

@section('content')
    <h2>Data Rombel</h2>
    <p>Home / Data Rombel</p>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <a href="{{ route('rombel.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Rombel</i></a>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Rombel</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($rombels as $item)
                <tr>
                    <td>{{ ($rombels->currentpage() - 1) * $rombels->perpage() + $loop->index + 1 }}</td>
                    <td>{{ $item['rombel'] }}</td>
                    <td class="d-flex">
                        <a href="{{ route('rombel.edit', $item['id']) }}" class="btn btn-primary me-2"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('rombel.delete', $item['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Hapus Data?');"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end">
        @if ($rombels->count())
            {{ $rombels->links() }}
        @endif
    </div>
@endsection
