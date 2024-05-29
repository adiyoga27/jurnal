<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){
        $date = Carbon::now()->subYear(1);
        $lastYear = $date->copy()->format('Y');
        $nowYear = Carbon::now()->format('Y');

        $summaryLastYear = $summaryNowYear =[];
        for ($i=1; $i <= 12; $i++) { 
            # code...
            $summaryLastYear[] = intval(Pengeluaran::where('kode_akun', 4)->whereMonth('tgl_transaksi', $i)->whereYear('tgl_transaksi', $lastYear)->sum('nominal'));
        }

        for ($i=1; $i <= 12; $i++) { 
            # code...
            $summaryNowYear[] = intval( Pengeluaran::where('kode_akun', 4)->whereMonth('tgl_transaksi', $i)->whereYear('tgl_transaksi', $nowYear)->sum('nominal'));
        }

      
        $debitAmount = Pengeluaran::whereHas('akun', function($q){
            $q->where('kategori_akun', 'debit');
        })->whereMonth('tgl_transaksi', Carbon::now()->format('m'))->whereYear('tgl_transaksi', Carbon::now()->format('Y'))->sum('nominal');
        
        $kreditAmount = Pengeluaran::whereHas('akun', function($q){
            $q->where('kategori_akun', 'kredit');
        })->whereMonth('tgl_transaksi', Carbon::now()->format('m'))->whereYear('tgl_transaksi', Carbon::now()->format('Y'))->sum('nominal');
       $kas = Pengeluaran::whereHas('akun', function($q){
            $q->where('kategori_akun', 'debit');
        })->sum('nominal') - Pengeluaran::whereHas('akun', function($q){
            $q->where('kategori_akun', 'kredit');
        })->sum('nominal');
        $result = array(
            'last' => $summaryLastYear,
            'now' => $summaryNowYear,
            'kredit' => $kreditAmount,
            'debit' => $debitAmount,
            'kas' => $kas
        );

        return view('home', $result);
    }
}
