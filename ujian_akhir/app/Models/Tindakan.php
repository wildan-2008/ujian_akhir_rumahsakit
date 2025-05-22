<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tindakan', 'biaya', 'kode_icd'
    ];

    public function detailTindakans()
    {
        return $this->hasMany(DetailTindakan::class);
    }
}

