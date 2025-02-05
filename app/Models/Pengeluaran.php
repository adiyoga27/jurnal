<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran';
    protected $fillable = [
        'tgl_transaksi',
        'kode_akun',
        'judul',
        'keterangan',
        'nominal',
        'referensi_no'
    ];
    public function akun(){
        return $this->hasOne(Akun::class, 'id', 'kode_akun');
    }
}
