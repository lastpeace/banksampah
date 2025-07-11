<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = ['tanggal', 'total_setoran', 'total_penarikan', 'saldo_akhir'];
}

