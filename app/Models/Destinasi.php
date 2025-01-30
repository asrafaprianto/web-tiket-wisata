<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destinasi extends Model
{
    use HasFactory;

    protected $fillable = ["destinasi_id","nama","gambar","alamat","kontak","peraturan"];

    public function user()
{
    return $this->hasMany(User::class);
}
public function produk()
{
    return $this->hasMany(Produk::class);
}

}
