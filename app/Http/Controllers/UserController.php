<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return view('layouts._action_dinamyc', [
                        'model'           => $data,
                        'delete'          => route('user.destroy', $data->id),
                        'edit'          => route('user.edit', $data->id),
                        'confirm_message' =>  'Anda akan menghapus data "' . $data->nama . '" ?',
                        'padding'         => '85px',
                    ]);
                })
            
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('content/users/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' =>'required|unique:users',
            'email' =>'required|unique:users',
            'password' => 'required',
            'no_telepon' =>'required',
            'role' =>'required',
        ]);
        try {
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
                'no_telepon' => $request->no_telepon,
                'role' => $request->role,
            ]);
            return redirect()->route('user.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal ditambahkan');
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
        $user = User::find($id);
        return view('content/users/edit')->with(compact(
            'user'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'username' =>'required|unique:users',
            'email' =>'required|unique:users',
            'no_telepon' =>'required',
            'role' =>'required',
        ]);
        try {
            if (!empty($request->password)) {
                User::where('id', $id)->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' =>  Hash::make($request->password),
                    'no_telepon' => $request->no_telepon,
                    'role' => $request->role,
                ]);
            }else{
                User::where('id', $id)->update([
                    'nama' => $request->nama,
                    'username' => $request->username,
                    'email' => $request->email,
                    'no_telepon' => $request->no_telepon,
                    'role' => $request->role,
                ]);
            }
            return redirect()->route('user.index')->with('success', 'Data berhasil diubah');
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
            User::destroy($id);
            return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors('Data gagal dihapus');
        }
    }
}
