<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Anggota::insert([
          [
              'id'  			=> 1,
              'user_id'  		=> 1,
              'npm'				=> 10000353,
              'nama' 			=> 'Admin GC',
              'tempat_lahir'	=> 'Banjarmasin',
              'tgl_lahir'		=> '2018-01-01',
              'jk'				=> 'L',
              'prodi'			=> 'TI',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
            [
              'id'  			=> 2,
              'user_id'  		=> 2,
              'npm'				=> 10000375,
              'nama' 			=> 'User GC',
              'tempat_lahir'	=> 'Banjarmasin',
              'tgl_lahir'		=> '2019-01-01',
              'jk'				=> 'L',
              'prodi'			=> 'TI',
              'created_at'      => \Carbon\Carbon::now(),
              'updated_at'      => \Carbon\Carbon::now()
            ],
        ]);
    }
}
