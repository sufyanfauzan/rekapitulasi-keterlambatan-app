<?php

namespace App\Exports;

use App\Models\students;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LatesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return students::with(['rombels', 'rayons', 'lates'])
            ->select('nis', 'name', 'rombel_id', 'rayon_id')
            ->withCount('lates') // Menghitung jumlah keterlambatan
            ->get()
            ->map(function ($student) {
                return [
                    'NIS' => $student->nis,
                    'Nama' => $student->name,
                    'Rombel' => $student->rombels->rombel,
                    'Rayon' => $student->rayons->rayon,
                    'Total Keterlambatan' => $student->lates_count,
                ];
            });
    }

    public function headings(): array
    {
        return ['NIS', 'Nama', 'Rombel', 'Rayon', 'Total Keterlambatan'];
    }
}
