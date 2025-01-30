<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_transaksi',
        'tanggal',
        'total_tiket',
        'total_harga',
        'dibayar',
        'kembalian',
        'produk',
    ];

    protected $casts = [
        'produk' => 'array', // Konversi JSON ke array
    ];
}