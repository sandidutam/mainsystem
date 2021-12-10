<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');




    	DB::table('users')->insert([
    		'nama_depan' => 'Sandi Duta',
    		'nama_belakang' => 'Maulana',
    		'email' => 'sandiduta@gmail.com',
            'password' => bcrypt('rahasia'),
            'role' => 'SuperAdmin',
            'remember_token' => Str::random(60),
    	]);


    }
}
