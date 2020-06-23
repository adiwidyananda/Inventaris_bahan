<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\bahan_keluar;
use PDF;

use Illuminate\Http\Request;

class BahanKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!session()->has('username')){
            
            return view('login');
        }
        $id =  $request->route('id');
        $makanan = DB::table('makanans')->where('id', $id)->first();
        $bahan = DB::table('bahans')->get();
        $bahan_keluar = DB::table('bahan_keluars')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_keluars.*', 'bahans.Satuan', 'bahans.Harga_Satuan','bahans.Nama_Bahan','bahans.Jumlah as Jumlah_Bahan')
            ->where('id_makanan', $id)
            ->get();
        return view('bahan_keluar/bahan_keluar')->with('makanan',$makanan)->with('bahan',$bahan)->with('bahan_keluar',$bahan_keluar);
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
        $bahan_keluar = new bahan_keluar;
        $bahan_keluar->id_bahan = $request->id_bahan;
        $bahan_keluar->Jumlah = $request->jumlah;
        $bahan_keluar->Harga_Total = $request->harga_total;
        $bahan_keluar->Tanggal_Keluar = date("Y-m-d");
        $bahan_keluar->id_makanan = $request->id_makanan;
        $bahan_keluar->save();
        $total = DB::table('bahan_keluars')
                     ->where('id_makanan','=', $request->id_makanan)
                     ->sum('Harga_Total');
        DB::table('makanans')
                     ->where('id', $request->id_makanan)
                     ->update(['Harga' => $total]);
        $dataJumlah = DB::table('bahans')
                        ->select('Jumlah')
                        ->where('id','=', $request->id_bahan)->first();
        // $stok = $stok - $request->jumlah;
        $stok =  $dataJumlah->Jumlah - $request->jumlah;
        echo $stok;
        DB::table('bahans')
                     ->where('id', $request->id_bahan)
                     ->update(['Jumlah' => $stok]);
        Session::flash('message', 'Bahan Keluar Berhasil Ditambah');
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
        $sebelumBKeluar = DB::table('bahan_keluars')->select('Jumlah')->where('id', '=', $request->id_BKeluar)->first();
        // $dataMakanan = DB::table('makanans')->where('id', '=', $request->id_makanan)->first();
        $databahan = DB::table('bahans')->select('Jumlah')->where('id', '=', $request->id_bahan)->first();
        $stok = $databahan->Jumlah + $sebelumBKeluar->Jumlah - $request->jumlahedit;
        DB::table('bahan_keluars')
                     ->where('id', $request->id_BKeluar)
                     ->update(['Harga_Total' => $request->harga_total]);
        DB::table('bahan_keluars')
                     ->where('id', $request->id_BKeluar)
                     ->update(['Jumlah' => $request->jumlahedit]);
                    
        DB::table('bahans')
                     ->where('id', $request->id_bahan)
                     ->update(['Jumlah' => $stok]);

        $total = DB::table('bahan_keluars')
                     ->where('id_makanan','=', $request->id_makanan)
                     ->sum('Harga_Total');
        DB::table('makanans')
                     ->where('id', $request->id_makanan)
                     ->update(['Harga' => $total]);
        Session::flash('message', 'Bahan Keluar Berhasil Diedit');
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
        $dataBKeluar = DB::table('bahan_keluars')->select('Jumlah','id_bahan','Harga_Total','id_makanan')->where('id', '=', $id)->first();
        $databahan = DB::table('bahans')->select('Jumlah')->where('id', '=', $dataBKeluar->id_bahan)->first();
        $datamakanan = DB::table('makanans')->select('Harga')->where('id', '=', $dataBKeluar->id_makanan)->first();
        $stok = $databahan->Jumlah + $dataBKeluar->Jumlah;
        $Harga = $datamakanan->Harga - $dataBKeluar->Harga_Total;
        DB::table('bahans')
                     ->where('id', $dataBKeluar->id_bahan)
                     ->update(['Jumlah' => $stok]);
        DB::table('makanans')
                     ->where('id', $dataBKeluar->id_makanan)
                     ->update(['Harga' => $Harga]);
        DB::table('bahan_keluars')->where('id', '=', $id)->delete();
        Session::flash('message', 'Bahan Keluar Berhasil Dihapus');
        return back();
    }
    public function buatlaporan()
    {
        return view('bahan_keluar.bkeluarlaporan');
    }
    public function laporan(Request $request)
    {

        $makanan = DB::table('makanans')
            ->where('makanans.Tanggal_Keluar','>=',$request->awal,'AND','makanans.Tanggal_Keluar','<=',$request->akhir)
            ->get();

        
        $bahan_keluar = DB::table('bahan_keluars')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_keluars.*', 'bahans.Satuan', 'bahans.Harga_Satuan','bahans.Nama_Bahan','bahans.Jumlah as Jumlah_Bahan')
            ->get();
        
        $awal = $request->awal;
        $akhir = $request->akhir;
        return view('bahan_keluar.laporan',['makanan'=>$makanan,'bahan_keluar'=>$bahan_keluar,'awal'=>$awal,'akhir'=>$akhir]);


    }
    public function cetak_pdf(Request $request)
    {
        $makanan = DB::table('makanans')
            ->where('makanans.Tanggal_Keluar','>=',$request->awal,'AND','makanans.Tanggal_Keluar','<=',$request->akhir)
            ->get();

        
        $bahan_keluar = DB::table('bahan_keluars')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_keluars.*', 'bahans.Satuan', 'bahans.Harga_Satuan','bahans.Nama_Bahan','bahans.Jumlah as Jumlah_Bahan')
            ->get();
        
        $awal = $request->awal;
        $akhir = $request->akhir;
        
        $pdf = PDF::loadview('bahan_keluar.pdf-laporan',['makanan'=>$makanan,'bahan_keluar'=>$bahan_keluar,'awal'=>$awal,'akhir'=>$akhir]);
    	return $pdf->download('dataBahanKeluar.pdf');
    }
}
