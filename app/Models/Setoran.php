<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'tanggal',
        'jenis_sampah',
        'item_sampah',
        'berat',
        'harga_per_kg',
        'total',
        'persentase_nasabah',
        'bagi_hasil_nasabah',
        'bagi_hasil_pengelola',
        'poin',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
