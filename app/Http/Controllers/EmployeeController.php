<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Employee::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model' => $data,
                        'delete' => route('employee.destroy', $data->id),
                        'edit' => route('employee.edit', $data->id),
                        'confirm_message' => 'Anda akan menghapus data "' . $data->nama_produk . '" ?',
                        'padding' => '85px',
                    ]);
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/employee/index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $nik = Carbon::now()->format('ymd').(1000+(Employee::withTrashed()->get()->count()+1));

        return view('content.employee.create', compact('nik'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {

        try {
            $payload = $request->toArray();
            if(isset($request->photo)){
                $payload['photo'] = $request->photo->store('images/employee', 'public');
            }
            Employee::create($payload);
            return redirect()->route('employee.index')->with('success', 'Data berhasil ditambahkan');
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
        $data = Employee::find($id);
        return view('content/employee/edit')->with(compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEmployeeRequest $request, string $id)
    {
 
        try {
            $payload = $request->except(['_method', '_token']);
            if(isset($request->photo)){
                $payload['photo'] = $request->photo->store('images/employee', 'public');
            }
            Employee::where('id', $id)->update($payload);
            return redirect()->route('employee.index')->with('success', 'Data berhasil diubah');
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
            Employee::destroy($id);
            return redirect()->route('employee.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal dihapus');
        }
    }
}
