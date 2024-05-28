<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Pengeluaran;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public static function checkAkunDebit($type, $month, $year){
        if(!Akun::where('kategori_akun', 'debit')->where('kode_akun', $type)->exists()){
            return 0;
        }
        $date = Carbon::parse($year."-".$month."-01");
        if($type == '10101'){
            $total = Transaction::whereBetween('paid_at', [$date->copy()->subMonth()->startOfMonth(), $date->copy()->subMonth()->endOfMonth()])->sum('total');
            $kredit = Pengeluaran::whereHas('akun', function($q){
                $q->where('kategori_akun', 'kredit');
            })->where('created_at', '<', $date)->sum('nominal');

            return $total - $kredit;
        }
        return Transaction::whereBetween('paid_at', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])->sum('total');
    }

    public static function checkAkunKredit($type, $month, $year){
        if(!Akun::where('kategori_akun', 'Kredit')->where('kode_akun', $type)->exists()){
            return 0;
        }
        $date = Carbon::parse($year."-".$month."-01");
        return   Pengeluaran::whereHas('akun', function($q) use($type){
            $q->where('kode_akun', $type);
        })->whereBetween('created_at', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])->sum('nominal');;
    }
}
