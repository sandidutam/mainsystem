<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function penempatan()
    {
        return $this->belongsTo(penempatan::class, 'penempatan_id');
    }

    public static function getId()
    {
        return $getId = DB::table('sektor')->orderBy('id','DESC')->take(1)->get();
    }
}
