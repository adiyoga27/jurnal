<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Pengeluaran;
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
        $type = $request->kategori;
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
        return view('content.report.buku-besar', compact('datas','month', 'year'));
    }
   
    
}
