<?php

namespace App\Http\Controllers;

use App\Models\rayons;
use App\Models\User;
use Illuminate\Http\Request;

class RayonsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Mendapatkan nilai perPage dari formulir atau menggunakan nilai default (5)
        $perPage = $request->input('perPage', 5);

        $rayons = Rayons::with('user')
            ->where(function ($query) use ($search) {
                $query->where('rayon', 'LIKE', '%' . $search . '%');
                $query->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'ASC')
            ->simplePaginate($perPage);

        return view('admin.data.dataRayon.data_rayon', compact('rayons', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role', 'ps')->get();
        return view('admin.data.dataRayon.create_data_rayon', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required',
        ]);

        Rayons::create([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil menambahkan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(rayons $rayons)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rayons = Rayons::find($id);
        $users = User::all()->where('role', 'ps');
        return view('admin.data.dataRayon.edit_data_rayon', compact('users', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'rayon' => 'required|min:3',
            'user_id' => 'required',
        ]);

        // Find the Rayon model instance by ID
        $rayons = Rayons::findOrFail($id);

        // Update the attributes
        $rayons->update([
            'rayon' => $request->rayon,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('rayon.index')->with('success', 'Berhasil mengubah data!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Rayons::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
