<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 

class Penempatan extends Model
{
    use HasFactory;
    protected $table = 'penempatan';
    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'kota',
        'provinsi'
    ];

    public function sektor()
    {
        return $this->hasMany(Sektor::class, 'penempatan_id');
    }

    public static function getId()
    {
        return $getId = DB::table('penempatan')->orderBy('id','DESC')->take(1)->get();
    }

}
