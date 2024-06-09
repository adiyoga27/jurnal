<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    function product(Request $request, $product_id) {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => Product::where('id', $product_id)->first()
        ]);
    }

    function syncHpp(){
        try {
            $transactions = Transaction::all();
        foreach ($transactions as $value) {
            $details = $value->details;
            $totalHpp = 0;
            foreach ($details as $d) {
                $totalHpp = $d->qty * $d->harga_beli;
            }
     
            if(!Pengeluaran::where('referensi_no', $value->noinvoice)->where('kode_akun', 5)->exists()){
                Pengeluaran::updateOrCreate([
                    'kode_akun' => 5,
                    'referensi_no' => $value->noinvoice,

                ],[
                    'tgl_transaksi' => $value->paid_at,
                    'kode_akun' => 5,
                    'judul' => "HPP Transaksi",
                    'keterangan' => "HPP Transaksi dengan No. $value->noinvoice",
                    'nominal' => $totalHpp,
                    'referensi_no' => $value->noinvoice,
                ]);
            }
        }
        } catch (\Throwable $th) {
            throw $th;
        }
       
    }
}
