<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\BahanMasuk;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

class BahanMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahan_masuk = DB::table('bahan_masuks')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_masuks.*','bahans.Nama_Bahan','bahans.Satuan')
            ->get();
        $bahan = DB::table('bahans')->get();
        return view('bahan_masuk.index')->with('bahan',$bahan)->with('bahan_masuk',$bahan_masuk);
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
        $jumlahbahan = DB::table('bahans')
                    ->select('Jumlah')
                    ->where('id','=',$request->id_bahan)
                    ->first();
        $stok = $jumlahbahan->Jumlah + $request->jumlah;
        DB::table('bahans')
                    ->where('id',$request->id_bahan)
                    ->update(['Jumlah'=>$stok]);
        $BahanMasuk = new BahanMasuk;
        $BahanMasuk->id_bahan = $request->id_bahan;
        $BahanMasuk->jumlah = $request->jumlah;
        $BahanMasuk->tanggal_masuk = date("Y-m-d");
        $BahanMasuk->harga = $request->total_harga;
        $BahanMasuk->id_admin = $request->id_admin;
        $BahanMasuk->save();
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
        $tot_klik = DB::table('bahan_masuks')
                    ->select('id_bahan','Jumlah')
                    ->where('id','=',$request->id_bahan)
                    ->first();
        $tot_bahan = DB::table('bahans')
                    ->select('Jumlah')
                    ->where('id', '=', $tot_klik->id_bahan)
                    ->first();
        $BahanMasuk = new BahanMasuk;
        $BahanMasuk->jumlah = $request->jumlah;
        $BahanMasuk->harga = $request->total_harga;
        // echo($Bahan->jumlah);
        $tot_skrg = $tot_bahan->Jumlah - $tot_klik->Jumlah + $BahanMasuk->jumlah;
        // // echo $tot_klik->jumlah;
        // // echo $tot_bahan->jumlah;
        // echo $tot_skrg;
        DB::table('bahans')
                ->where('id',$tot_klik->id_bahan)
                ->update(['jumlah'=>$tot_skrg]);
        DB::table('bahan_masuks')
                ->where('id',$request->id_bahan)
                ->update(['jumlah'=>$BahanMasuk->jumlah]);
        DB::table('bahan_masuks')
                ->where('id',$request->id_bahan)
                ->update(['harga'=>$BahanMasuk->harga]);
        Session::flash('message', 'Bahan Masuk Berhasil Diedit');
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
        $jml_hapus = DB::table('bahan_masuks')
                    ->select('id_bahan','Jumlah')
                    ->where('id','=',$id)
                    ->first();
        $jml_bahan = DB::table('bahans')
                    ->select('Jumlah')
                    ->where('id', '=', $jml_hapus->id_bahan)
                    ->first();
        $stok_skrg = $jml_bahan->Jumlah-$jml_hapus->Jumlah;
        echo $stok_skrg;
        DB::table('bahans')
                    ->where('id', $jml_hapus->id_bahan)
                    ->update(['jumlah' => $stok_skrg]);
        DB::table('bahan_masuks')->where('id', '=', $id)->delete();
        Session::flash('message', 'Bahan Masuk Berhasil Dihapus');
        return back();
    }
    public function buatlaporan()
    {
        return view('bahan_masuk.bmasuklaporan');
    }
    public function laporan(Request $request)
    {
        $laporan = DB::table('bahan_masuks')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_masuks.*','bahans.Nama_Bahan','bahans.Satuan')
            ->where('Tanggal_Masuk','>=',$request->awal,'AND','Tanggal_Masuk','<=',$request->akhir)
            ->get();
        $awal = $request->awal;
        $akhir = $request->akhir;
        return view('bahan_masuk.laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);


    }
    public function cetak_pdf(Request $request)
    {

        $laporan = DB::table('bahan_masuks')
            ->join('bahans', 'id_bahan', '=', 'bahans.id')
            ->select('bahan_masuks.*','bahans.Nama_Bahan','bahans.Satuan')
            ->where('Tanggal_Masuk','>=',$request->awal,'AND','Tanggal_Masuk','<=',$request->akhir)
            ->get();
        $awal = $request->awal;
        $akhir = $request->akhir;

        $pdf = PDF::loadview('bahan_masuk.pdf-laporan',['laporan'=>$laporan,'awal'=>$awal,'akhir'=>$akhir]);
    	return $pdf->download('dataBahanMasuk.pdf');
    }
}
