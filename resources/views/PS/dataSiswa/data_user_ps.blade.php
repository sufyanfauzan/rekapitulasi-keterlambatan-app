@extends('layouts.template')

@section('content')
    <h2>Data Siswa</h2>
    <p>Home / Data Siswa</p>
    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp
            @foreach ($students as $student)
                <tr>
                    {{-- <td>{{ ($rombels->currentpage() - 1) * $rombels->perpage() + $loop->index + 1 }}</td> --}}
                    <td>no 1</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->rombels->rombel }}</td>
                    <td>{{ $student->rayons->rayon }}</td> 
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="d-flex justify-content-end">
        @if ($rombels->count())
            {{ $rombels->links() }}
        @endif
    </div> --}}
@endsection

