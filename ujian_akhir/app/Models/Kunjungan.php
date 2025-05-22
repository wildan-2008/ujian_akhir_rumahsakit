<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kunjungan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id', 'doctor_id', 'tanggal_kunjungan', 'keluhan'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function detailTindakans()
   {
    return $this->hasMany(DetailTindakan::class);
   }


}
