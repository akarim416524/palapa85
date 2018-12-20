<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'      => 'administrator',
            'no_pegawai'    => '000001',
            'no_anggota'    => '000001',
            'nama_lengkap'  => 'administrator',
            'tanggal_lahir' => '2000-06-08',
            'no_telp'       => '081250386912',
            'alamat'        => 'jalan administrator',
            'hak_akses'     => 'pelaksana',
            'email'         => 'administrator@admin.com',
            'password'      => bcrypt('administrator'),
        ]);
        $user = User::create([
            'username'      => 'pengurus1',
            'no_pegawai'    => '000002',
            'no_anggota'    => '000002',
            'nama_lengkap'  => 'pengurus1',
            'tanggal_lahir' => '2000-06-08',
            'no_telp'       => '081250386912',
            'alamat'        => 'jalan pengurus1',
            'hak_akses'     => 'pengurus',
            'email'         => 'pengurus1@gmail.com',
            'password'      => bcrypt('pengurus1'),
        ]);
        $user = User::create([
            'username'      => 'pengurus2',
            'no_pegawai'    => '000003',
            'no_anggota'    => '000003',
            'nama_lengkap'  => 'pengurus2',
            'tanggal_lahir' => '2000-06-08',
            'no_telp'       => '081250386912',
            'alamat'        => 'jalan pengurus2',
            'hak_akses'     => 'pengurus',
            'email'         => 'pengurus2@gmail.com',
            'password'      => bcrypt('pengurus2'),
        ]);
        $user = User::create([
            'username'      => 'anggota1',
            'no_pegawai'    => '000004',
            'no_anggota'    => '000004',
            'nama_lengkap'  => 'anggota1',
            'tanggal_lahir' => '2000-06-08',
            'no_telp'       => '081250386912',
            'alamat'        => 'jalan anggota1',
            'hak_akses'     => 'anggota',
            'email'         => 'anggota1@gmail.com',
            'password'      => bcrypt('anggota1'),
        ]);
        $user = User::create([
            'username'      => 'anggota2',
            'no_pegawai'    => '000005',
            'no_anggota'    => '000005',
            'nama_lengkap'  => 'anggota2',
            'tanggal_lahir' => '2000-06-08',
            'no_telp'       => '081250386912',
            'alamat'        => 'jalan anggota2',
            'hak_akses'     => 'anggota',
            'email'         => 'anggota2@gmail.com',
            'password'      => bcrypt('anggota2'),
        ]);
    }
}
