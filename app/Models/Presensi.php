<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Presensi extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = [
            'nomor_pegawai',
            'nama_lengkap',
            'jabatan',
            'sektor_area',
            'tanggal',
            'jam_masuk',
            'jam_keluar',
            'catatan_masuk',
            'catatan_keluar',
            'keterangan'
    ];

    /**
     * Get the pegawai that owns the Presensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public static function getId()
    {
        return $getId = DB::table('presensi')->orderBy('id','DESC')->take(1)->get();
    }


    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function catatan()
    {
        return $this->catatan_masuk.' '.$this->catatan_keluar;
    }

    /**
     * Get the user that owns the Presensi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

}
