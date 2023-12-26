<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rombels extends Model
{
    use HasFactory;

    protected $fillable = [
        'rombel',
    ];
  
    public function students()
    {
        return $this->hasMany(students::class, 'rombel_id', 'id');
    }
}
