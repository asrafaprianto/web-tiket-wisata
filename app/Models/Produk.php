<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model {
    use HasFactory;

    protected $table = 'produks';
    protected $fillable = ['produk_id', 'nama_produk', 'harga'];

    // Fungsi untuk membuat produk_id unik
    public static function generateProdukId() {
        do {
            $randomNumber = mt_rand(1000, 9999); // Generate random 4-digit number
            $produkId = 'PDK-' . $randomNumber;
        } while (self::where('produk_id', $produkId)->exists());

        return $produkId;
    }
}