<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class neraca extends Model
{
    use HasFactory;
    protected $table = 'neraca';
    protected $fillable = [
        'nomor_akun',
        'akun',
        'deskripsi',
        'debit',
        'kredit',
        'tanggal',
        'foto_bukti',
        'file_bukti',

    ];

    public function getGambarBukti()
    {
        if(!$this->foto_bukti) {
            return asset('images/transaksi/default.jpg');
        }

        return asset('images/transaksi/'.$this->foto_bukti);
    }

    public function getFileBukti()
    {
        if(!$this->file_bukti) {
            return asset('docs/transaksi/default.pdf');
        }

        return asset('docs/transaksi/'.$this->file_bukti);
    }

    public function formattanggal()
    {
        $src = $this->tanggal;
        $tgl_norm = Carbon::createFromFormat('Y-m-d', $src)->format('d F Y');
        return $tgl_norm;
    }

    public function sumdebit()
    {
        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        return $sumdebit;
    }

    public function sumkredit()
    {
        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        return $sumkredit;
    }

    public function balance()
    {
        $sumdebit = DB::table('neraca')
                        ->whereNotNull('debit')
                        ->sum('debit');

        $sumkredit = DB::table('neraca')
                        ->whereNotNull('kredit')
                        ->sum('kredit');

        $balance = $sumdebit - $sumkredit;
        return $balance;
    }
}
