<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function jurnal(Request $request) {
        $akuns = Akun::get();
        $datas = [];
        foreach ($akuns as $v) {
            $datas[]  = array(
                'nama_akun' => $v->nama_akun,
                'kode_akun' => $v->kode_akun,
                'sub_akun' => $v->sub_akun,
                'debit' => 1000000,
                'kredit' => 0,
            );
        }

        return view('content.report.jurnal', compact('datas'));
    }
    
}
