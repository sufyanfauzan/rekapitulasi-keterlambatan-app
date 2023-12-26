@extends('layouts.template')

@section('content')
    <h2>Data Keterlambatan</h2>
    <p>Home / Keterlambatan</p>
    <div class="my-5">
        <a href="" class="btn btn-info text-white">Export</a>
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
        <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Informasi</th>
                        <th>Bukti</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1 @endphp
                    @foreach ($lates as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->student->name }}</td>
                            <td>{{ $item->date_time_late }}</td>
                            <td>{{ $item->information }}</td>
                            <td><img src="{{ URL('storage/images/' . $item->bukti) }}" alt="" width="150"></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- <div class="d-flex justify-content-end">
                @if ($rombels->count())
                    {{ $rombels->links() }}
                @endif
            </div> --}}
        </div>
        <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah Keterlambatan</th>
                        <th>Informasi</th>
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
                                <td>{{ $item->student->name }}</td>
                                <td>{{ $item->student->lates->count() }}</td>
                                <td>{{ $item->information }}</td>
                                <td class="d-flex">
                                    <a href="{{ route('terlambat.show', $item->student_id) }}" class="btn btn-primary me-2">Show</a>
                                    @if ($item->student->lates->count() >= 1)
                                        <form action="{{ route('terlambat.terlambatCetakPdf', $item->student_id) }}" method="post">
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
@endsection
