<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\DB;
use App\Models\Pegawai;
use App\Models\Presensi;
use Illuminate\Support\Carbon;

class PresensiBolosUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'presensi:bolos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $timestamp = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d H:i:s');

        Pegawai::whereDoesntHave('presensi', function ($query) {
                                    $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                                    $query->where('tanggal', $today);
                                })->insert([
                                    'pegawai_id' => $item->id,
                                    'tanggal' => $today,
                                    'jam_masuk' => '-',
                                    'jam_keluar' => '-',
                                    'catatan_masuk' => '-',
                                    'catatan_keluar' => '-',
                                    'keterangan' => 'Bolos',
                                    'created_at' => $timestamp,
                                    'updated_at' => $timestamp
                                    ]);

        // $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');

        // foreach ( $data as $item ) {
        //     DB::table('presensi')->insert([
        //                                 'pegawai_id' => $item->id,
        //                                 'tanggal' => $today,
        //                                 'jam_masuk' => '-',
        //                                 'jam_keluar' => '-',
        //                                 'catatan_masuk' => '-',
        //                                 'catatan_keluar' => '-',
        //                                 'keterangan' => 'Bolos',
        //                                 'created_at' => $timestamp,
        //                                 'updated_at' => $timestamp
        //                                 ]);
        // }

        return Command::SUCCESS;
    }
}
