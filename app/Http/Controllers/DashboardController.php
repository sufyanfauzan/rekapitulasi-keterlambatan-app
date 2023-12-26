<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rayons;
use App\Models\rombels;
use App\Models\students;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $rayons = rayons::count();
        $rombels = rombels::count();
        $students = students::count();
        $userPs = User::where('role', 'ps')->count();
        $userAdmin = User::where('role', 'admin')->count();

        return view('admin.index', compact('rayons', 'rombels', 'students', 'userPs', 'userAdmin'));
    }
    public function indexSiswa()
    {
        $userIdLogin = Auth::id();
        $rayonIdLogin = rayons::where('user_id', $userIdLogin)->value('id');
        $totalStudents = students::where('rayon_id', $rayonIdLogin)->count();
        $totalLates = students::where('rayon_id', $rayonIdLogin)->with('lates')->get()->sum(function ($student) {
            return $student->lates->count();
        });
        $todayLates = students::where('rayon_id', $rayonIdLogin)
            ->whereHas('lates', function ($query) {
                $query->whereDate('created_at', now()->toDateString());
            })
            ->count();

        return view('ps.index', compact('totalStudents', 'totalLates', 'todayLates', 'rayonIdLogin'));
    }
}
