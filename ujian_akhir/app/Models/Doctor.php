<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'spesialisasi', 'jadwal_praktek', 'no_str'
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}