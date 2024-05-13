<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_transactions';
    protected $fillable = [
        'transaction_id',
        'noinvoice',
        'product_id',
        'kode_produk',
        'nama_produk',
        'qty',
        'harga_beli',
        'harga_jual',
        'total',
    ];
}
