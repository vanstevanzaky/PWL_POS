<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id'=> 1,
                'supplier_kode'=> 'SPP001',
                'supplier_nama'=> 'Stevan Zaky Setyanto',
                'supplier_alamat'=> 'Jl. Jendral Basuki'
            ],
            [
                'supplier_id'=> 2,
                'supplier_kode'=> 'SPP002',
                'supplier_nama'=> 'Zaky Anto Van',
                'supplier_alamat'=> 'Jl. Panglima Perang'   
            ],
            [
                'supplier_id'=> 3,
                'supplier_kode'=> 'SPP003',
                'supplier_nama'=> 'Van Ky Anto',
                'supplier_alamat'=> 'Jl. Raja Pajajaran'   
            ],
            [
                'supplier_id'=> 4,
                'supplier_kode'=> 'SPP004',
                'supplier_nama'=> 'Setyanto Kyky Van',
                'supplier_alamat'=> 'Jl. Pahlawan Nasional'   
            ],
            

        ];
        DB::table('m_supplier')->insert($data);
    }
}
