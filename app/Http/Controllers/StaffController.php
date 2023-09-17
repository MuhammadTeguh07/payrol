<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        $users = User::all(); // Mengambil semua data pengguna (users)
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->place_birth = $request->place_birthd;
        $user->date_birth = $request->date_birthd;
        $user->gender = $request->gender;
        $user->position = $request->position;
        $user->status = $request->status;
        $user->basic_salary = $request->basic_salary;
        $user->subsidi = $request->subsidi;
        $user->bpjs = $request->bpjs;
        $user->date_join = $request->date_join;
        $user->save();

        return response()->json(['message' => 'Berhasil tambah data']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Perbarui data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->place_birth = $request->place_birthd;
        $user->date_birth = $request->date_birthd;
        $user->gender = $request->gender;
        $user->position = $request->position;
        $user->status = $request->status;
        $user->basic_salary = $request->basic_salary;
        $user->subsidi = $request->subsidi;
        $user->bpjs = $request->bpjs;
        $user->date_join = $request->date_join;
        // Kolom-kolom lain sesuai kebutuhan Anda

        // Simpan perubahan
        $user->save();

        return response()->json(['message' => 'Berhasil ubah data']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        // Cari data yang akan dihapus
        $data = User::find($id);

        // Hapus data
        $data->delete();

        return response()->json(['message' => 'Berhasil hapus data']);
    }
}
