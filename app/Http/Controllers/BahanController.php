<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use PDF;

class BahanController extends Controller
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
        $kategori = DB::table('kategoris')->get();

        $bahan = DB::table('kategoris')
            ->join('bahans', 'id_kategori', '=', 'kategoris.id')
            ->get();
        return view('bahan.bahan')->with('bahan',$bahan)->with('kategori',$kategori);
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
        $bahan = new bahan;
        $bahan->Nama_Bahan = $request->namabahan;
        $bahan->Jumlah = $request->jumlahbahan;
        $bahan->Satuan = $request->satuanbahan;
        $bahan->Harga_Satuan = $request->hargabahan;
        $bahan->id_kategori = $request->id_kategori;
        $bahan->save();
        Session::flash('message', 'Bahan Berhasil Ditambah');
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
        DB::table('bahans')
        ->where('id', $request->id_bahan)
        ->update(['Nama_Bahan' => $request->namabahan]);

        DB::table('bahans')
                     ->where('id', $request->id_bahan)
                     ->update(['Satuan' => $request->satuanbahan]);
               
        DB::table('bahans')
                     ->where('id', $request->id_bahan)
                     ->update(['Harga_Satuan' => $request->hargabahan]);
        
        Session::flash('message', 'Bahan Berhasil Diedit');
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
        DB::table('bahans')->where('id', '=', $id)->delete();
        Session::flash('message', 'Bahan Berhasil Dihapus');
        return back();
    }
    public function cetak_pdf()
    {

        $bahan = DB::table('kategoris')
            ->join('bahans', 'id_kategori', '=', 'kategoris.id')
            ->get();
        
            // return view('bahan.bahanpdf',['bahan'=>$bahan]);
 
        $pdf = PDF::loadview('bahan.bahanpdf',['bahan'=>$bahan]);
    	return $pdf->download('dataBahan.pdf');
    }
}
