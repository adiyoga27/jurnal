<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\DetailTransaction;
use App\Models\Pengeluaran;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    function jurnal(Request $request)  {
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");
        $datas = [];
        for ($i=1; $i <= $date->copy()->endOfMonth()->format('d') ; $i++) { 
            # code...
            $formatedDateSearch = $date->copy()->startOfMonth()->addDays($i-1)->format('Y-m-d');
            $totalsByKodeAkun = Pengeluaran::whereDate('tgl_transaksi', $formatedDateSearch)
            ->groupBy('kode_akun')
            ->selectRaw('kode_akun, SUM(nominal) as total_sum')
            ->get();
            if(count($totalsByKodeAkun) >0 ){
                $contents = [];
                
                $d = array(
                    'tanggal' => $date->copy()->startOfMonth()->addDays($i-1)->format('d M'),
                    'rows' => count($totalsByKodeAkun)
                );
                foreach ($totalsByKodeAkun as $total) {
                        $akun = Akun::where('id', $total->kode_akun)->first();
                        if($akun->kategori_akun == 'debit'){
                         
                            $contents[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => 0,
                                'kredit' => $total->total_sum,
                            );
                        }else{
                            $contents[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => $total->total_sum,
                                'kredit' => 0,
                            );
                      
                        }
                    
                }
                $datas[] = array_merge($d, array('contents' => $contents));
            }
            // $jurnal = Pengeluaran::whereDate('tgl_transaksi', $date->copy()->startOfMonth()->addDays($i-1));
        }

        //      $datas = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->groupBy('kode_akun', 'judul')->select('tgl_transaksi')->get();;
        // dd($datas);
        return view('content.report.jurnal', compact('datas','month', 'year'));
    }

    function bukuBesar(Request $request)  {
        $akuns = Akun::all();
        $akun = Akun::where('id', $request->akun)->first();
        $akunID = $akun->id ?? 1;
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");
        $dateBefore = $date->copy()->subDays($month-1)->endOfMonth()->format('Y-m-d');
        $datas = [];

        $saldoDebit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'debit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $saldoKredit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'kredit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $saldo = $saldoDebit - $saldoKredit;

        if($akunID == 1) {

        for ($i=1; $i <= $date->copy()->endOfMonth()->format('d') ; $i++) { 
            # code...
            $formatedDateSearch = $date->copy()->startOfMonth()->addDays($i-1)->format('Y-m-d');
            $totalsByKodeAkun = Pengeluaran::whereDate('tgl_transaksi', $formatedDateSearch)
            ->groupBy('kode_akun')
            ->selectRaw('kode_akun, SUM(nominal) as total_sum')
            ->orderBy('id', 'asc')
            ->get();

            if(count($totalsByKodeAkun) >0 ){
                
            
                foreach ($totalsByKodeAkun as $total) {
                        $akun = Akun::where('id', $total->kode_akun)->first();
                        if($akun->kategori_akun == 'debit'){
                         
                            $datas[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => 0,
                                'kredit' => $total->total_sum,
                            );
                        }else{
                            $datas[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => $total->total_sum,
                                'kredit' => 0,
                            );
                      
                        }
                    
                }
            }
        }
    }else{
        for ($i=1; $i <= $date->copy()->endOfMonth()->format('d') ; $i++) { 
            # code...
            $formatedDateSearch = $date->copy()->startOfMonth()->addDays($i-1)->format('Y-m-d');
            $totalsByKodeAkun = Pengeluaran::whereDate('tgl_transaksi', $formatedDateSearch)
            ->whereHas('akun', function($q) use ($akunID) {
                $q->where('id', $akunID);
            })
            ->groupBy('kode_akun')
            ->selectRaw('kode_akun, SUM(nominal) as total_sum')
            ->orderBy('id', 'asc')
            ->get();

            if(count($totalsByKodeAkun) >0 ){
                
            
                foreach ($totalsByKodeAkun as $total) {
                        $akun = Akun::where('id', $total->kode_akun)->first();
                        if($akun->kategori_akun == 'debit'){
                         
                            $datas[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => 0,
                                'kredit' => $total->total_sum,
                            );
                        }else{
                            $datas[] = array(
                                'tanggal' => $formatedDateSearch,
                                'keterangan' => $akun->nama_akun,
                                'debit' => $total->total_sum,
                                'kredit' => 0,
                            );
                      
                        }
                    
                }
            }
        }  
    }

        return view('content.report.buku-besar', compact('datas','month', 'year', 'akuns','akunID', 'saldo'));
    }
   
    function perubahanModal(Request $request)  {
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");
        $dateBefore = $date->copy()->subDays($month-1)->endOfMonth()->format('Y-m-d');
        $saldoDebit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'debit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $saldoKredit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'kredit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $modal = $saldoDebit - $saldoKredit;

        $formatedDateSearch = $date->copy()->startOfMonth()->addDays($month-1)->format('Y-m-d');
        $prive = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)
        ->whereHas('akun', function($q) {
            $q->where('kode_akun', '30102');
        })
        ->groupBy('kode_akun')
        ->sum('nominal');
        $laba = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)
        ->whereHas('akun', function($q) {
            $q->where('kategori_akun', 'debit')->where('kode_akun', '<>','30102');
        })
        ->groupBy('kode_akun')
        ->sum('nominal') - Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)
        ->whereHas('akun', function($q) {
            $q->where('kategori_akun', 'kredit')->where('kode_akun', '<>','30102');
        })
        ->groupBy('kode_akun')
        ->sum('nominal') ;

        return view('content.report.perubahan-modal', compact('month', 'year', 'modal', 'prive', 'laba'));

    }
    function arusKas(Request $request)  {
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");
        $dateBefore = $date->copy()->subDays($month-1)->endOfMonth()->format('Y-m-d');
        $saldoDebit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'debit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $saldoKredit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'kredit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $modal = $saldoDebit - $saldoKredit;

        $arus = [];
        $akuns = Akun::all();
        foreach ($akuns as $key => $value) {
            $arus[] = array(
                    'akun' => $value->nama_akun,
                    'kategori' => $value->kategori_akun,
                    'nominal' => Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', $value->id)->sum('nominal'),
                );

        }
        return view('content.report.arus-kas', compact('month', 'year', 'modal','arus'));

    }
    function neraca(Request $request)  {
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");
        $dateBefore = $date->copy()->subDays($month-1)->endOfMonth()->format('Y-m-d');
        $saldoDebit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'debit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $saldoKredit = Pengeluaran::whereHas('akun', function($q) {
            $q->where('kategori_akun', 'kredit');
        })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        $modal = $saldoDebit - $saldoKredit;

        $arus = [];
        $akuns = Akun::orderBy('kategori_akun', 'asc')
                    ->whereNotIn('nama_akun', ['Beban Gaji','Pengambilan Prive','Beban HPP'])
                    ->get();
        foreach ($akuns as $key => $value) {
            if($value->kode_akun == '10101'){
                $arus[] = array(
                    'akun' => $value->nama_akun,
                    'kategori' => $value->kategori_akun,
                    'nominal' => $modal,
                );
            }else{
                $nomin = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', $value->id)->sum('nominal');
                if($value->kode_akun == '30101'){
                    $nomin = $modal - $nomin + Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', '4')->sum('nominal');
                }
                $arus[] = array(
                    'akun' => $value->nama_akun,
                    'kategori' => $value->kategori_akun,
                    'nominal' => $nomin,
                );
            }
           

        }
        return view('content.report.neraca', compact('month', 'year', 'modal','arus'));

    }

    function labaRugi(Request $request)  {
        $month = isset($request->month)? $request->month : date('m');
        $year = isset($request->year)? $request->year : date('Y');
        $date = Carbon::parse($year."-".$month."-01");



        $transaksiTotal = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', 4)->sum('nominal');
        $hppTotal = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', 5)->sum('nominal');
       
        $akuns = Akun::where('sub_akun', 'Beban')->get();
        foreach ($akuns as $value) {
            $nominal = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', $value->id)->sum('nominal');
            if($nominal  > 0){

                $beban[] = array(
                    'title' => $value->nama_akun,
                    'nominal' => $nominal,
                    'tipe' => 'kredit'
                );
            }
        }
        $results = [];
        if($transaksiTotal > 0){
            $results = [
                array(
                    'akun' => 'Pendapatan',
                    'details' => [
                        array(
                            'title' => 'Penjualan Bersih',
                            'nominal' => $transaksiTotal,
                            'tipe' => 'debit'

                        )
                    ]
                ),
                array(
                    'akun' => 'Beban',
                    'details' => $beban
                ),
            ];
        }
        // $dateBefore = $date->copy()->subDays($month-1)->endOfMonth()->format('Y-m-d');
        // $saldoDebit = Pengeluaran::whereHas('akun', function($q) {
        //     $q->where('kategori_akun', 'debit');
        // })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        // $saldoKredit = Pengeluaran::whereHas('akun', function($q) {
        //     $q->where('kategori_akun', 'kredit');
        // })->whereDate('tgl_transaksi', "<=",  $dateBefore)->sum('nominal');
        // $modal = $saldoDebit - $saldoKredit;

        // $arus = $results= [];
        // $akuns = Akun::orderBy('sub_akun', 'asc')->groupBy('sub_akun')->select('sub_akun')->get();
        // foreach ($akuns as $key => $value) {
        //     if($value->sub_akun != 'Kas'){
        //         $arrayAkun = Akun::where('sub_akun', $value->sub_akun)->get();
        //         $arus = array(
        //             'sub' => $value->sub_akun,
        //         );
        //         $ak = [];
        //         $total = 0;
        //         foreach ($arrayAkun as $key => $a) {
        //             $nominal = Pengeluaran::whereMonth('tgl_transaksi', $month)->whereYear('tgl_transaksi', $year)->where('kode_akun', $a->id)->sum('nominal');
        //             if($nominal >0){

        //                 $ak[] =  array(
        //                     'akun' => $a->nama_akun,
        //                     'kategori' => $a->kategori_akun,
        //                     'nominal' => $nominal,
        //                 );
        //             }
        //             $total += $nominal;
        //         }
        //         if($total > 0){

        //             $results[] = array_merge($arus, [
        //                 'content' => $ak,
        //                 'total' => $total
        //             ]);
        //         }
            
        //     }
        // }
        return view('content.report.laba-rugi', compact('month', 'year','results'));

    }
}
