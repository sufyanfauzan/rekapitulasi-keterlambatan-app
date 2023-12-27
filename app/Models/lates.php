<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lates extends Model
{
    use HasFactory;

    
    protected $table = 'lates';
    protected $fillable = [
        'student_id',
        'name',
        'date_time_late',
        'information',
        'bukti',
    ];
    
    public function student()
    {
        return $this->belongsTo(students::class, 'student_id', 'id');
    }
    
    public function lates()
    {
        return $this->hasMany(lates::class, 'student_id');
    }

    public function rayons()
    {
        return $this->belongsTo(Rayons::class, 'rayon_id');
    }
}
