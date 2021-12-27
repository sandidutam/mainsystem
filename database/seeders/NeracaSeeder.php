<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NeracaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 10; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('neraca')->insert([
    			'akun' => $faker->randomElement(['Transaksi Debit','Transaksi Kredit']),
    			'deskripsi' => $faker->sentence(4),
    			'tanggal' => $faker->dateTimeThisYear(),
    			'tahun' => $faker->randomElement(['2020','2021']),
    			'bulan' => $faker->randomElement(['1','2','3','4','5','6','7','8','9','10','11','12']),
    			'created_at' => $faker->date,
    			'updated_at' => $faker->date,
    		]);
    	}
    }
}

