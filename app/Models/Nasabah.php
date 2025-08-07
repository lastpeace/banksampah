<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    protected $fillable = ['nama','no_induk', 'alamat', 'no_hp', 'saldo'];

    public function setorans()
    {
        return $this->hasMany(Setoran::class);
    }

    public function penarikans()
    {
        return $this->hasMany(Penarikan::class);
    }
}

