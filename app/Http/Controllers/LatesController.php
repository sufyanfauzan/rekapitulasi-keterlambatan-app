<?php

namespace App\Http\Controllers;

use App\Models\lates;
use App\Models\students;
use App\Models\rayons;
use Illuminate\Http\Request;
use PDF;
use Excel;
use App\Exports\LatesExport;
use Illuminate\Support\Facades\Auth;

class LatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lates = lates::all();
        // $lates = lates::with('student.lates')->get();
        $students = students::all();
        return view('admin.data.dataTerlambat.data_terlambat', compact('lates', 'students'));
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
            $filename = $file->getClientOriginalName();
            $file->storeAs('images', $filename, 'public');
            $data['bukti'] = $filename;
        }

        $data['student_id'] = $request->student_id;

        Lates::create($data);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }


    /**
     * Display the specified resource.
     */
    public function show($student_id)
    {
        $student = students::find($student_id);
        $lates = lates::where('student_id', $student_id)->get();

        return view('admin.data.dataTerlambat.show_data_terlambat', compact('lates', 'student'));
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
    public function destroy(lates $lates)
    {
        //
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
        return Excel::download(new LatesExport, 'keterlambatan.xlsx');
    }

    public function indexSiswa()
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

        // Get students in the specified rayon with late information
        $students = students::with(['rayons', 'rombels'])
            ->where('rayon_id', $rayonIdLogin)
            ->get();

        // Fetch late information for each student in the specified rayon
        $students->each(function ($student) {
            $student->lates = lates::where('student_id', $student->id)->get();
        });

        // Filter late information to include only the ones in the specified rayon
        $lates = lates::whereIn('student_id', $students->pluck('id'))->get();

        return view('PS.dataTerlambat.data_terlambat_ps', compact('students', 'lates'));
    }
}
