<?php

namespace App\Exports;

use App\Models\lates;
use App\Models\rayons;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Auth;

class latesExportPs implements FromCollection, WithHeadings
{
    private $userIdLogin;
    private $rayonIdLogin;

    public function __construct($userIdLogin, $rayonIdLogin)
    {
        $this->userIdLogin = $userIdLogin;
        $this->rayonIdLogin = $rayonIdLogin;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return lates::with('student')
            ->whereHas('student.rayons', function ($query) {
                // Menambahkan kondisi untuk memfilter berdasarkan rayon user yang login
                $query->where('rayon_id', $this->rayonIdLogin);
            })
            ->get()
            ->groupBy('student_id')
            ->map(function ($group) {
                $lates = $group->first(); // Mengambil record pertama jika ada beberapa untuk murid yang sama

                return [
                    $lates->student->nis,
                    $lates->student->name,
                    $lates->student->rombels->rombel,
                    $lates->student->rayons->rayon,
                    $group->count()
                ];
            });
    }


    public function headings(): array
    {
        return [
            'NIS', 'Nama', 'Rombel', 'Rayon', 'Total Keterlambatan'
        ];
    }
}