<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    protected $fillable = ['nasabah_id', 'tanggal', 'jumlah'];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }
}
