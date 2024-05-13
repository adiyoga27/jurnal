<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'employees';
    protected $fillable = [
        'kode_karyawan',
        'nama_karyawan',
        'hp',
        'tgl_lahir',
        'alamat',
        'tgl_gabung',
        'photo'
    ];

}
