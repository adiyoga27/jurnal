<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model' => $data,
                        'delete' => route('product.destroy', $data->id),
                        'edit' => route('product.edit', $data->id),
                        'confirm_message' => 'Anda akan menghapus data "' . $data->nama_produk . '" ?',
                        'padding' => '85px',
                    ]);
                })
                ->addColumn('harga_beli', function ($data) {
                    return "Rp".number_format($data->harga_beli,0,",",".");
                })
                ->addColumn('harga_jual', function ($data) {
                    return "Rp".number_format($data->harga_jual,0,",",".");
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/product/index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $payload = $request->toArray();
            if(isset($request->image)){
                $payload['image'] = $request->image->store('images/product', 'public');
            }
            Product::create($payload);
            return redirect()->route('product.index')->with('success', 'Data berhasil ditambahkan');
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
        $data = Product::find($id);
        return view('content/product/edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreProductRequest $request, string $id)
    {
 
        try {
            $payload = $request->except(['_method', '_token']);
            if(isset($request->image)){
                $payload['image'] = $request->image->store('images/product', 'public');
            }
            Product::where('id', $id)->update($payload);
            return redirect()->route('product.index')->with('success', 'Data berhasil diubah');
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
            Product::destroy($id);
            return redirect()->route('product.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal dihapus');
        }
    }
}
