<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Matakuliah;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function hasil()
    {
        return $this->hasMany(Hasil::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class);
    }
}
