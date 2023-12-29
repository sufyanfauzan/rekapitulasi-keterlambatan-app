<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\students;
use App\Models\rayons;
use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\LatesExport;
use App\Exports\LatesExportPs;
use Illuminate\Support\Facades\Auth;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 5);

        $query = Lates::with('student')
            ->where(function ($query) use ($search) {
                $query->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('nis', 'LIKE', '%' . $search . '%')
                        ->orWhere('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'ASC');

        $lates = ($perPage === 'all') ? $query->get() : $query->simplePaginate($perPage);

        $students = Students::all();

        return view('admin.data.dataTerlambat.data_terlambat', compact('lates', 'students', 'search', 'perPage'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = students::all();
        return view('admin.data.dataTerlambat.create_data_terlambat', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('bukti')) {
            $file = $request->file('bukti');
            $filename = $file->hashName();
            $file->storeAs('images', $filename, 'public');
            $data['bukti'] = $filename;
        }

        $data['student_id'] = $request->student_id;

        Lates::create($data);

        return redirect()->route('terlambat.index')->with('success', 'Berhasil menambahkan data!');
    }


    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $student = students::find($student_id);
        $lates = lates::where('student_id', $student_id)->get();
        $role = auth()->user()->role;

        if ($role === 'admin') {
           return view('admin.data.dataTerlambat.show_data_terlambat', compact('lates', 'student'));
        } else {
            return view('PS.dataTerlambat.show_data_terlambat_ps', compact('lates', 'student'));
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(lates $lates, $id)
    {
        $lates = lates::find($id);
        $students = students::all();
        return view('admin.data.dataTerlambat.edit_data_terlambat', compact('lates', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, lates $lates, $id)
    {
        $request->validate([
            'date_time_late' => 'required',
            'information' => 'required',
            'bukti' => 'nullable|file|mimes:jpeg,png,jpg,gif',
        ]);

        // Check if a new file is uploaded before updating
        if ($request->hasFile('bukti')) {
            $filename = $request->file('bukti')->getClientOriginalName();
            $request->file('bukti')->move('storage/images/', $filename);

            // Update with the new file
            Lates::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
                'bukti' => $filename,
            ]);
        } else {
            // Update without changing the existing file
            Lates::where('id', $id)->update([
                'date_time_late' => $request->date_time_late,
                'information' => $request->information,
            ]);
        }

        return redirect()->route('terlambat.index')->with('success', 'Berhasil mengubah data!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        lates::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function cetakPdf($studentId)
    {
        // $student = students::find($studentId);
        $student = students::with('rombels', 'rayons')->find($studentId);

        // $pdf = PDF::loadView('admin.data.dataTerlambat.download_data_terlambat', compact('student'));
        // return $pdf->stream('laporan_keterlambatan.pdf');

        $pdf = PDF::loadView('admin.data.dataTerlambat.download_data_terlambat', compact('student'));
        $pdfFileName = 'terlambat_' . $studentId . '.pdf';

        // Mendownload file PDF langsung
        return $pdf->download($pdfFileName);
    }

    public function export()
    {
        $role = auth()->user()->role;

        if ($role === 'admin') {
            return Excel::download(new LatesExport, 'keterlambatan.xlsx');
        } else {
            $userIdLogin = Auth::id();
            $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

            return Excel::download(new LatesExportPs($userIdLogin, $rayonIdLogin), 'keterlambatan.xlsx');
        }
    }


    public function indexSiswa(Request $request)
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        // query dasar untuk data siswa
        $query = students::with(['rayons', 'rombels'])
            ->where('rayon_id', $rayonIdLogin);

        $query->when($search, function ($query) use ($search) {
            $query->where('nis', 'LIKE', '%' . $search . '%')
                ->orWhere('name', 'LIKE', '%' . $search . '%');
        });

        $students = $query->get();

        $students->each(function ($student) {
            $student->lates = lates::where('student_id', $student->id)->get();
        });

        $latesQuery = lates::whereIn('student_id', $students->pluck('id'))->orderBy('created_at', 'ASC');

        $lates = ($perPage === 'all') ? $latesQuery->get() : $latesQuery->simplePaginate($perPage);

        return view('PS.dataTerlambat.data_terlambat_ps', compact('students', 'lates', 'search', 'perPage'));
    }
}
