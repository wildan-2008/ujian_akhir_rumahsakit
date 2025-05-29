<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'nik', 'tanggal_lahir', 'alamat', 'no_hp'
    ];

    public function kunjungans()
    {
        return $this->hasMany(Kunjungan::class);
    }
}
