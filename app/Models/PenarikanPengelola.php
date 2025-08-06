<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenarikanPengelola extends Model
{
    protected $fillable = ['tanggal', 'jumlah', 'keterangan'];
}