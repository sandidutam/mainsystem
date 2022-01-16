<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sektor extends Model
{
    use HasFactory;
    protected $table = 'sektor';
    protected $fillable = [
        'kode_sektor',
        'nama_sektor'
    ];

    public function user()
    {
        return $this->hasMany(Pegawai::class);
    }

}
