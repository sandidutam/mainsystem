<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventori extends Model
{
    use HasFactory;
    protected $table = 'inventori';
    protected $fillable = [
        'kode_barang',
        'nama',
        'merk',
        'jenis',
        'deskripsi',
        'kuantitas',
        'satuan',
        'harga',
        'gambar',
        'stok_minimal',
        'status'

    ];

    public function getGambarBarang()
    {
        if(!$this->gambar) {
            return asset('images/inventori/default.jpg');
        }
        
        return asset('images/inventori/'.$this->gambar);
    }

}
