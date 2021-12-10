<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = [
        'nomor_pegawai',
        'nama_depan',
        'nama_belakang',
        'nama_lengkap',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'provinsi',
        'kota_kabupaten',
        'kecamatan',
        'kelurahan',
        'pendidikan',
        'jabatan',
        'penempatan',
        'sektor_area',
        'tanggal_diterima',
        'no_hp',
        'foto_pegawai',

    ];

    public function getFotoPegawai()
    {
        if(!$this->foto_pegawai) {
            return asset('images/pegawai/default.jpg');
        }

        return asset('images/pegawai/'.$this->foto_pegawai);
    }

    public static function getId()
    {
        return $getId = DB::table('pegawai')->orderBy('id','DESC')->take(1)->get();
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class,'pegawai_id');
    }

    public function nama_lengkap()
    {
        return $this->nama_depan.' '.$this->nama_belakang;
    }


}
