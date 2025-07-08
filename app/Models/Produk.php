<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    //
    use HasFactory;

    // Nama tabel (opsional jika sama dengan nama model dalam bentuk jamak)
    protected $table = 'produks';

    // Kolom yang bisa diisi (mass assignable)
    protected $fillable = [
        'nama',
        'harga',
    ];
}
