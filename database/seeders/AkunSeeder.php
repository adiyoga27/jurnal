<?php

namespace Database\Seeders;

use App\Models\Akun;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Akun::insert([[
            'sub_akun' => 'Aktiva Lancar',
            'kode_akun' => '10101',
            'nama_akun' => 'Kas',
            'kategori_akun' => 'debit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),

        ],
        // [
        //     'sub_akun' => 'Aktiva Lancar',
        //     'kode_akun' => '10102',
        //     'nama_akun' => 'Bank',
        //     'kategori_akun' => 'debit',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ],[
        //     'sub_akun' => 'Aktiva Lancar',
        //     'kode_akun' => '10103',
        //     'nama_akun' => 'Persediaan Barang Dagang',
        //     'kategori_akun' => 'debit',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ],
        [
            'sub_akun' => 'Kewajiban Lancar',
            'kode_akun' => '20101',
            'nama_akun' => 'Hutang Usaha',
            'kategori_akun' => 'kredit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'sub_akun' => 'Modal',
            'kode_akun' => '30101',
            'nama_akun' => 'Modal Perusahaan',
            'kategori_akun' => 'kredit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],
        [
            'sub_akun' => 'Modal',
            'kode_akun' => '30102',
            'nama_akun' => 'Pengambilan Prive',
            'kategori_akun' => 'kredit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],[
            'sub_akun' => 'Penjualan',
            'kode_akun' => '40102',
            'nama_akun' => 'Penjualan',
            'kategori_akun' => 'debit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],[
            'sub_akun' => 'Beban',
            'kode_akun' => '50101',
            'nama_akun' => 'Beban HPP',
            'kategori_akun' => 'kredit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ],[
            'sub_akun' => 'Beban',
            'kode_akun' => '50102',
            'nama_akun' => 'Beban Gaji',
            'kategori_akun' => 'kredit',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]]
    
    );
    }
}
