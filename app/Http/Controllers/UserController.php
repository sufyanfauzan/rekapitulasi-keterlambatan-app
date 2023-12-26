<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = User::orderBy('created_at', 'ASC')->simplePaginate(5);
        return view('admin.data.dataUser.data_user', compact('user'));
    }

    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = $request->only(['email', 'password']);

        if (Auth::attempt($user)) {
            // Check the user's role after successful login
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect('/dashboard/admin');
            } elseif ($role === 'ps') {
                return redirect('/dashboard/ps');
            } else {
                // Handle other roles or scenarios
                return redirect('/dashboard');
            }
        } else {
            return redirect()->back()->with('failed', 'Email / Password salah, silahkan coba lagi');
        }
    }


    public function logout()
    {
        // menghapus session
        Auth::logout();
        return redirect()->route('login');
    }

    public function create()
    {
        return view('admin.data.dataUser.create_data_user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $defaultPassword = Str::substr($request->email, 0, 3) . Str::substr($request->name, 0, 3);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($defaultPassword)
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.data.dataUser.edit_data_user', compact('user'));
    }

    public function update(Request $request, User $id)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required',
            'role' => 'required',
        ]);

        $dataToUpdate = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ];
        
        // form name pass 
        if ($request->filled('pass')) {
            $dataToUpdate['password'] = bcrypt($request->input('pass'));
        }

        $id->update($dataToUpdate);

        return redirect()->route('user.index')->with('success', 'Berhasil mengubah data!');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('deleted', 'Berhasil menghapus data!');
    }
}
