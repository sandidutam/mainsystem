<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PegawaiBolosUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pegawai:status';

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
        Pegawai::whereDoesntHave('presensi', function ($query) {
            $today = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
            $query->where('tanggal', $today);
            })->update([
            'status' => 'Tidak Hadir'
            ]);

        return Command::SUCCESS;
    }
}
