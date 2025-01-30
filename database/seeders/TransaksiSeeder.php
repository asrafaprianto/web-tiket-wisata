<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;


class TransaksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaksis')->insert([
            [
                'no_transaksi' => 'TRX-20250101-001',
                'tanggal' => '2025-01-01',
                'total_tiket' => 3,
                'total_harga' => 9000,
                'dibayar' => 10000,
                'kembalian' => 1000,
                'produk' => json_encode([
                    ['nama' => 'Anak-anak', 'qty' => 2, 'harga' => 6000],
                    ['nama' => 'Dewasa', 'qty' => 1, 'harga' => 3000],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_transaksi' => 'TRX-20250102-002',
                'tanggal' => '2025-01-02',
                'total_tiket' => 5,
                'total_harga' => 15000,
                'dibayar' => 20000,
                'kembalian' => 5000,
                'produk' => json_encode([
                    ['nama' => 'Anak-anak', 'qty' => 3, 'harga' => 9000],
                    ['nama' => 'Dewasa', 'qty' => 2, 'harga' => 6000],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'no_transaksi' => 'TRX-20250103-003',
                'tanggal' => '2025-01-03',
                'total_tiket' => 2,
                'total_harga' => 6000,
                'dibayar' => 10000,
                'kembalian' => 4000,
                'produk' => json_encode([
                    ['nama' => 'Dewasa', 'qty' => 2, 'harga' => 6000],
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}