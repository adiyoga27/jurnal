<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaction;
use App\Models\Pengeluaran;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::select('*')->orderBy('paid_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model' => $data,
                        'delete' => route('transaction.destroy', $data->id),
                        'view' => route('transaction.print', $data->noinvoice),
                        'confirm_message' => 'Anda akan menghapus data "' . $data->noinvoice . '" ?',
                        'padding' => '85px',
                    ]);
                })
                
                ->addColumn('total', function ($data) {
                    return "Rp".number_format($data->total,0,",","."); 
                })
                ->addColumn('paid_at', function ($data) {
                    return Carbon::parse($data->paid_at)->format('d M Y');   
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/transaction/index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('content/transaction/create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'customer_name' => $request->customer_nama,
                'customer_phone' => $request->customer_phone,
                'paid_at' => $request->paid_at,
                'keterangan' => $request->keterangan
            ]);
            $total = 0;
            for($i=0; $i<count($request->product_id); $i++){
                $product = Product::where('id', $request->product_id[$i])->first();
                DetailTransaction::create([
                    'transaction_id'=> $transaction->id,
                    'product_id' =>$product->id,
                    'kode_produk' =>$product->kode_produk,
                    'nama_produk' =>$product->nama_produk,
                    'qty' => $request->qty[$i],
                    // 'harga_beli' => $request->harga_beli[$i],
                    'harga_beli' =>$product->harga_beli,
                    'harga_jual' => $request->harga_jual[$i],
                    'total' => $request->qty[$i] * $request->harga_jual[$i]
                ]);
                $total = $total+($request->qty[$i] * $request->harga_jual[$i]);
                
            }
           tap($transaction->update([
                'total' => $total
            ]));

            Pengeluaran::create([
                'tgl_transaksi' => $request->paid_at,
                'kode_akun' => 4,
                'judul' => "Transaksi",
                'keterangan' => "Transaksi dengan No. $transaction->noinvoice",
                'nominal' => $total,
                'referensi_no' => $transaction->noinvoice,
            ]);
            DB::commit();
            //code...
            return redirect()->route('transaction.print', $transaction->noinvoice)->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->withErrors('Data gagal dihapus '.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Transaction::destroy($id);
            return redirect()->route('transaction.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Data gagal dihapus '.$th->getMessage());
            //throw $th;
        }
    }

    public function print(Request $request, string $noinvoice) {
        $data = Transaction::where('noinvoice',$noinvoice)->first();
        return view('content.transaction.print', compact('data'));
    }
}
