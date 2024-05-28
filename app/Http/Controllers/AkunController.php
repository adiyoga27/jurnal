<?php

namespace App\Http\Controllers;

use App\Http\Requests\Akun\AkunStoreRequest;
use App\Models\Akun;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AkunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Akun::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model' => $data,
                        'delete' => route('akun.destroy', $data->id),
                        'edit' => route('akun.edit', $data->id),
                        'confirm_message' => 'Anda akan menghapus data "' . $data->nama_akun . '" ?',
                        'padding' => '85px',
                    ]);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/akun/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.akun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AkunStoreRequest $request)
    {
        try {
            Akun::create([
                'kode_akun' => $request->kode_akun,
                'nama_akun' => $request->nama_akun,
                'sub_akun'  => $request->sub_akun,
                'kategori_akun' => $request->kategori_akun,
            ]);
            return redirect()->route('akun.index')->with('success', 'Data berhasil ditambahkan');
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
        $data = Akun::find($id);
        return view('content/akun/edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_akun' => 'required',
            'nama_akun' => 'required',
            'sub_akun' =>'required',
            'kategori_akun' => 'required',
        ]);
        try {
            Akun::where('id', $id)->update([
                'kode_akun' => $request->kode_akun,
                'nama_akun' => $request->nama_akun,
                'sub_akun'  => $request->sub_akun,
                'kategori_akun' => $request->kategori_akun,
            ]);
            return redirect()->route('akun.index')->with('success', 'Data berhasil diubah');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Akun::destroy($id);
            return redirect()->route('akun.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal dihapus');
        }
    }
}
