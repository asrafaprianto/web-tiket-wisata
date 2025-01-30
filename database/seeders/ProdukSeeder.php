<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produks')->insert([
            [
                'produk_id' => Produk::generateProdukId(),
                'nama_produk' => 'Dewasa',
                'harga' => 5000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'produk_id' => Produk::generateProdukId(),
                'nama_produk' => 'Anak-anak max 12thn',
                'harga' => 3000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}