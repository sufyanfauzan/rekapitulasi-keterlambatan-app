@extends('layouts.template')

@section('content')
    <h2>Data User</h2>
    <p>Home / Data User</p>
    <br>
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <div class="d-flex justify-content-between">
        <a href="{{ route('user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah User</i></a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3 text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1 @endphp
                @foreach ($user as $item)
                    <tr>
                        <td>{{ ($user->currentpage() - 1) * $user->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['role'] }}</td>
                        <td class="d-flex">
                            <a href="{{ route('user.edit', $item['id']) }}" class="btn btn-primary me-2"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('user.delete', $item['id']) }}" method="post">
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
    </div>
    <div class="d-flex justify-content-end">
        @if ($user->count())
            {{ $user->links() }}
        @endif
    </div>
@endsection

{{-- @push('script')

@endpush --}}
