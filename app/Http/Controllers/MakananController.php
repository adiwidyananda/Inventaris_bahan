<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Makanan;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!session()->has('username')){
            
            return view('login');
        }
    $makanan = DB::table('makanans')->get();
    return view('bahan_keluar.makanan')->with('makanan',$makanan);
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
        $makanan = new makanan;
        $makanan->Nama_Makanan = $request->nama;
        $makanan->Harga = $request->harga;
        $makanan->id_admin = $request->id_admin;
        $makanan->Tanggal_Keluar = date("Y-m-d");
        $makanan->save();
        Session::flash('message', 'Makanan Berhasil Ditambah');
        return back();
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
    public function edit(Request $request)
    {
        DB::table('makanans')
                     ->where('id', $request->id)
                     ->update(['Nama_Makanan' => $request->nama]);
                     Session::flash('message', 'Makanan Berhasil Diedit');
        return back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('bahan_keluars')
                        ->where('id_makanan','=',$id)->get()->count();
                     
        if ($data > 0) {
            Session::flash('message', 'Hapus terlebih dahulu data bahan yang terdapat pada makanan, sebelum menghapus data makanan (hapus data bahan pada detail)'); 
            return back(); 
        }else{
        DB::table('makanans')->where('id', '=', $id)->delete();
        Session::flash('message', 'Data Berhasil Dihapus');
        return back();
        }
    }
}
