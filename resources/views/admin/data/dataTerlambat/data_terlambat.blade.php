@extends('layouts.template')

@section('content')
    <h2>Data Keterlambatan</h2>
    <p><a href="{{ route('admin.index') }}">Dashboard</a> / Data Keterlambatan</p>
    <div class="my-5">
        <a href="{{ route('terlambat.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Keterlambatan</a>
        <a href="{{ route('terlambat.export') }}" class="btn btn-info text-white"><i class="fas fa-file-excel"></i> Export
            Excel</a>
    </div>
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab"
                aria-controls="simple-tabpanel-0" aria-selected="true">Keseluruhan Data</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab"
                aria-controls="simple-tabpanel-1" aria-selected="false">Rekapitulasi Data</a>
        </li>
    </ul>

    @if (Session::get('success'))
        <div class="alert alert-success mt-3">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning mt-3">{{ Session::get('deleted') }}</div>
    @endif

    <div class="tab-content mt-3" id="tab-content">
        <div class="d-md-flex justify-content-between align-items-center">
            <form action="{{ route('terlambat.index') }}" method="get" class="d-flex">
                <select name="perPage" class="form-control text-center" id="perPage" onchange="this.form.submit()"
                    style="width: 50px">
                    <option value="5" {{ $perPage == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20</option>
                    <option value="all" {{ $perPage === 'all' ? 'selected' : '' }}>All</option>
                </select>
                <div class="form-control form-control text-center">
                    entries per page
                </div>
            </form>
            <form action="{{ route('terlambat.index') }}" method="get" class="d-flex mt-3">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari Siswa"
                    value="{{ $search }}">
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                <a href="{{ route('terlambat.index') }}" class="btn btn-secondary"><i class="fas fa-sync"></i></a>
            </form>
        </div>

        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Informasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @foreach ($lates as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->student->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($item['date_time_late'])->format('Y-m-d H:i') }}</td>
                                <td>{{ $item['information'] }}</td>
                                {{-- <td><img src="{{ URL('storage/images/' . $item['bukti']) }}" alt="" width="150"></td> --}}
                                <td class="d-flex">
                                    <a href="{{ route('terlambat.edit', $item['id']) }}" class="btn btn-primary me-2"><i
                                            class="fas fa-edit"></i></a>
                                    <form action="{{ route('terlambat.delete', $item['id']) }}" method="post">
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
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3 text-center">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Jumlah Keterlambatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 @endphp
                        @php $processedStudentIds = [] @endphp
                        @foreach ($lates as $item)
                            @if (!in_array($item->student->id, $processedStudentIds))
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->student->nis }}</td>
                                    <td>{{ $item->student->name }}</td>
                                    <td>{{ $item->student->lates->count() }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('terlambat.show', $item->student_id) }}"
                                            class="btn btn-primary me-2"><i class="fas fa-eye"></i> Lihat</a>
                                        @if ($item->student->lates->count() >= 3)
                                            <form action="{{ route('terlambat.terlambatCetakPdf', $item->student_id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-file-pdf"></i> Cetak PDF</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @php $processedStudentIds[] = $item->student->id @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
