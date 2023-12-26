<?php

namespace App\Http\Controllers;

use App\Models\rombels;
use Illuminate\Http\Request;

class RombelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $perPage = $request->input('perPage', 5);
        if ($search) {
            $rombels = Rombels::where('rombel', 'LIKE', '%' . $search . '%')
                ->orderBy('created_at', 'ASC')
                ->simplePaginate($perPage);
        } else {
            $rombels = Rombels::orderBy('created_at', 'ASC')->simplePaginate($perPage);
        }

        return view('admin.data.dataRombel.data_rombel', compact('rombels', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.data.dataRombel.create_data_rombel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rombel' => 'required|min:3',
        ]);

        Rombels::create([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rombels $rombels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rombels = Rombels::find($id);
        return view('admin.data.dataRombel.edit_data_rombel', compact('rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, rombels $id)
    {
        $request->validate([
            'rombel' => 'required',
        ]);

        $id->update([
            'rombel' => $request->rombel,
        ]);

        return redirect()->route('rombel.index')->with('success', 'Berhasil mengubah data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rombels::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
