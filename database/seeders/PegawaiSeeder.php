<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

    	for($i = 1; $i <= 40; $i++){

    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('pegawai')->insert([
                'status' => 'Belum Hadir',
                'nomor_pegawai' => 'PGW-'.random_int(100000, 999999),
    			'nama_depan' => $faker->firstName,
    			'nama_belakang' => $faker->lastName,
    			'tempat_lahir' => $faker->city,
    			'tanggal_lahir' => $faker->date,
    			'jenis_kelamin' => $faker->randomElement(['L','P']),
    			'agama' => $faker->randomElement(['Islam','Kristen','Katolik','Hindu','Buddha']),
    			'alamat' => $faker->streetAddress,
    			'provinsi' => $faker->state,
    			'kota_kabupaten' => $faker->city,
    			'kecamatan' => $faker->randomElement(['Pasar Minggu','Pancoran']),
    			'kelurahan' => $faker->randomElement(['Kalibata','Pejaten Barat']),
    			'pendidikan' => $faker->randomElement(['S-1','S-2','Diploma','SMA']),
    			'jabatan' => $faker->randomElement(['Manajer','Mandor','Staff','Cleaning Service']),
    			'penempatan' => 'Mabes TNI AD',
    			'sektor_area' => $faker->randomElement(['1','2','3','4']),
    			'tanggal_diterima' => $faker->date,
    			'no_hp' => $faker->phoneNumber,
    			'foto_pegawai' => 'default.jpeg',

    		]);

    	}
    }
}
