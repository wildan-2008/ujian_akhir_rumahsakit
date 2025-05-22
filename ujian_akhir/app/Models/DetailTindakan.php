<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kunjungan_id', 'tindakan_id', 'keterangan'
    ];

    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }
}