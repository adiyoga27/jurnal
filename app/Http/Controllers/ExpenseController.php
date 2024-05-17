<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expense\StoreExpenseRequest;
use App\Models\Akun;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Pengeluaran::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model' => $data,
                        'delete' => route('expense.destroy', $data->id),
                        'edit' => route('expense.edit', $data->id),
                        'confirm_message' => 'Anda akan menghapus data "' . $data->judul . '" ?',
                        'padding' => '85px',
                    ]);
                })
                ->addColumn('kode_akun', function ($data) {
                    return $data->akun->kode_akun ."-".$data->akun->nama_akun;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/expense/index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $akuns = Akun::all();
        return view('content.expense.create', compact('akuns'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {

        try {
            $payload = $request->toArray();
      
            Pengeluaran::create($payload);
            return redirect()->route('expense.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Failed to created ".$th->getMessage());
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
        $akuns = Akun::all();

        $data = Pengeluaran::find($id);
        return view('content/expense/edit')->with(compact('data', 'akuns'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreExpenseRequest $request, string $id)
    {
 
        try {
            $payload = $request->except(['_method', '_token']);

            Pengeluaran::where('id', $id)->update($payload);
            return redirect()->route('expense.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal diubah, '.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Pengeluaran::destroy($id);
            return redirect()->route('expense.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal dihapus');
        }
    }
}
