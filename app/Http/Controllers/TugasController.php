<?php

namespace App\Http\Controllers;

use App\Tugas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tugas = Tugas::all();
        return response()->json($tugas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'description' => 'required'
        ]);
        if($validate->passes()) {
            $tugas = Tugas::create($request->all());
            return response()->json([
                'pesan' => 'Data Berhasil Disimpan',
                'data' => $tugas

            ]); 
            return Tugas::create($request->all());
        }
        return response()->json([
            'pesan' => 'Data Gagal Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function show($tugas)
    {
        $data = Tugas::where('id', $tugas)->first();
        if(!empty($data)){

        
        return $data;
        }
        return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tugas $tugas)
    {
        $tugas->update($request->all());
        return response()->json([
            'pesan' => 'Data berhasil diupdate',
            'data' => $tugas
        ]);
        //Mengambil semua data
        // var_dump($tugas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tugas  $tugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($tugas)
    {
        $data = Tugas::where('id',$tugas)->first();
        if(empty($data)){
            return response()->json([
                'pesan' => 'Data Tidak Ditemukan'
            ], 404);
        }
        
        $data->delete();
        return response()->json([
            'pesan' => 'Data Berhasil Dihapus'
        ], 200);
    }
}
