<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'cpf' => '12345678910',
            'email' => 'admin@gmail.com',
            'password' =>  bcrypt('1234'),
            'papel_id' =>  1,
            'created_at' =>  '2022-11-01',
        ]);
    }
}
