<?php

namespace App\Http\Controllers;

use App\Models\students;
use App\Models\Rayons;
use App\Models\Rombels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mendapatkan nilai perPage dari formulir atau menggunakan nilai default (5)
        $perPage = $request->input('perPage', 5);

        $students = Students::with(['rayons', 'rombels'])
            ->where(function ($query) use ($search) {
                $query->where('nis', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('rayons', function ($rayonQuery) use ($search) {
                        $rayonQuery->where('rayon', 'LIKE', '%' . $search . '%');
                    })
                    ->orWhereHas('rombels', function ($rombelQuery) use ($search) {
                        $rombelQuery->where('rombel', 'LIKE', '%' . $search . '%');
                    });
            })
            ->orderBy('created_at', 'ASC')
            ->simplePaginate($perPage);

        $rayons = Rayons::all();
        $rombels = Rombels::all();

        return view('admin.data.dataSiswa.data_siswa', compact('rayons', 'rombels', 'students', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayons = Rayons::all();
        $rombels = Rombels::all();
        return view('admin.data.dataSiswa.create_data_siswa', compact('rayons', 'rombels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rayon_id' => 'required',
            'rombel_id' => 'required',
        ]);

        Students::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'rayon_id' => $request->rayon_id,
            'rombel_id' => $request->rombel_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(students $students)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $students = Students::find($id);
        $rombels = Rombels::all();
        $rayons = Rayons::all();
        return view('admin.data.dataSiswa.edit_data_siswa', compact('students', 'rombels', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, students $students, $id)
    {
        $student = Students::find($id);
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'rayon_id' => 'required',
            'rombel_id' => 'required',
        ]);

        $student->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'rayon_id' => $request->rayon_id,
            'rombel_id' => $request->rombel_id,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Students::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }

    public function indexSiswa(Request $request)
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

        // Mendapatkan nilai perPage dari formulir atau menggunakan nilai default (5)
        $perPage = $request->input('perPage', 5);
        $search = $request->input('search');

        $students = students::with('rayons', 'rombels')
            ->where('rayon_id', $rayonIdLogin)
            ->when($search, function ($query) use ($search) {
                $query->where('nis', 'LIKE', '%' . $search . '%')
                    ->orWhere('name', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'ASC')
            ->paginate($perPage);

        return view('PS.dataSiswa.data_user_ps', compact('students', 'perPage', 'search'));
    }


    // public function indexSiswa()
    // {
    //     $userIdLogin = Auth::id();
    //     $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');

    //     // Menggunakan metode get() untuk mendapatkan koleksi data siswa
    //     $students = students::with('rayons', 'rombels')
    //         ->where('rayon_id', $rayonIdLogin)
    //         ->get();

    //     return view('PS.dataSiswa.data_user_ps', compact('students'));
    // }
}
