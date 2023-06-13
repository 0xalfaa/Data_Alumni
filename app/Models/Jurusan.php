<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'jurusan';
    protected $fillable = [
        'nama_jurusan'
    ];

    public function prodi()
    {
        return $this->hasMany(Prodi::class);
    }

    public function alumnus()
    {
        return $this->hasMany(Alumnus::class);
    }
}
