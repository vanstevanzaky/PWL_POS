<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'barang_id'=> 1,
                'kategori_id'=> 1,
                'barang_kode' =>'BMM001',
                'barang_nama' => 'Air Mineral 600ml',
                'harga_beli' => 3000,
                'harga_jual' => 3500
            ],
            [
                'barang_id'=> 2,
                'kategori_id'=> 1,
                'barang_kode' =>'BMM002',
                'barang_nama' => 'Roti Tawar',
                'harga_beli' => 12000,
                'harga_jual' => 12500
            ],
            [
                'barang_id' => 3,
                'kategori_id'=>2,
                'barang_kode' =>'BPA001',
                'barang_nama'=>'Kemeja Putih',
                'harga_beli'=>125000,
                'harga_jual'=>130000
            ],
            [
                'barang_id' => 4,
                'kategori_id'=>2,
                'barang_kode' =>'BPA002',
                'barang_nama'=>'Kaos Polo',
                'harga_beli'=>85000,
                'harga_jual'=>90000
            ],
            [
                'barang_id' => 5,
                'kategori_id'=>3,
                'barang_kode' =>'BPK001',
                'barang_nama'=>'Face Wash',
                'harga_beli'=>35000,
                'harga_jual'=>40000
            ],
            [
                'barang_id' => 6,
                'kategori_id'=>3,
                'barang_kode' =>'BPK002',
                'barang_nama'=>'Liptint',
                'harga_beli'=>40000,
                'harga_jual'=>45000
            ],
            [
                'barang_id' => 7,
                'kategori_id'=>4,
                'barang_kode' =>'BPR001',
                'barang_nama'=>'Sapu',
                'harga_beli'=>10000,
                'harga_jual'=>15000
            ],
            [
                'barang_id' => 8,
                'kategori_id'=>4,
                'barang_kode' =>'BPR002',
                'barang_nama'=>'Alat Pel',
                'harga_beli'=>80000,
                'harga_jual'=>90000
            ],
            [
                'barang_id' => 9,
                'kategori_id'=>5,
                'barang_kode' =>'BKB001',
                'barang_nama'=>'Susu Bayi',
                'harga_beli'=>10000,
                'harga_jual'=>130000
            ],
            [
                'barang_id' => 10,
                'kategori_id'=>5,
                'barang_kode' =>'BKB002',
                'barang_nama'=>'Sabun Bayi',
                'harga_beli'=>45000,
                'harga_jual'=>50000
            ],

        ];
        DB::table('m_barang')->insert($data);
    }
}
