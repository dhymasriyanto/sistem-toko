<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'level_akses' => 'Pemilik Toko',
            'id_grup' => null
        ]);
    }
}
