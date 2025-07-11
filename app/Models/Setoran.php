<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setoran extends Model
{
    protected $fillable = ['nasabah_id', 'tanggal', 'jenis_sampah', 'berat', 'harga_per_kg', 'total'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}

