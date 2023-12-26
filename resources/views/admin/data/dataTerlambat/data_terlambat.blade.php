@extends('layouts.template')

@section('content')
    <h2>Data Keterlambatan</h2>
    <p>Home / Data Keterlambatan</p>
    <div class="my-5">
        <a href="{{ route('terlambat.create') }}" class="btn btn-primary">Tambah Keterlambatan</i></a>
        <a href="{{ route('terlambat.export') }}" class="btn btn-info text-white">Export</i></a>
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
    <div class="tab-content pt-5" id="tab-content">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3">
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
                        @foreach ($lates as $index => $item)
                            <tr>
                                {{-- <td>{{ ($rombels->currentpage() - 1) * $rombels->perpage() + $loop->index + 1 }}</td> --}}
                                <td>{{ $index + 1 }}</td>
                                {{-- <td>{{ $item->student->nis }}</td> --}}
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item['date_time_late'] }}</td>
                                <td>{{ $item['information'] }}</td>
                                {{-- <td><img src="{{ URL('storage/images/' . $item['bukti']) }}" alt="" width="150"></td> --}}
                                <td class="d-flex">
                                    <a href="{{ route('terlambat.edit', $item['id']) }}" class="btn btn-primary me-2"><i
                                            class="fas fa-edit"></i></a>
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
            </div>
            {{-- <div class="d-flex justify-content-end">
              @if ($rombels->count())
                  {{ $rombels->links() }}
              @endif
          </div> --}}
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nis</th>
                            <th>Nama</th>
                            <th>Jumlah Keterlambatan</th>
                            <th>Informasi</th>
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
                                    <td>{{ $item->information }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('terlambat.show', $item->student_id) }}"
                                            class="btn btn-primary me-2">Lihat</a>
                                        @if ($item->student->lates->count() >= 3)
                                            <form action="{{ route('terlambat.terlambatCetakPdf', $item->student_id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Cetak PDF</button>
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
