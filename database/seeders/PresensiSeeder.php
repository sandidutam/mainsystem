<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 50; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('presensi')->insert([
                'pegawai_id' => random_int(1, 99),
    			'tanggal' => $faker->dateTimeThisMonth(),
                'jam_masuk' => '07:00:00',
                'jam_keluar' => '17:00:00',
                'catatan_masuk' => '-',
                'catatan_keluar' => '-',
    			'keterangan' => $faker->randomElement(['Hadir','Bolos','Cuti','Sakit','Izin']),
    			'created_at' => $faker->dateTimeThisMonth(),
    			'updated_at' => $faker->dateTimeThisMonth(),
    		]);

    	}
    }
}
