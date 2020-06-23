<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Kategori;

use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        if(!session()->has('username')){
            
            Session::flash('message', 'Login Terlebih Dahulu');
            return view('login');
        }
        $kategori = DB::table('kategoris')
        ->get();
        return view('bahan.kategori')->with('kategori',$kategori);

    }
    public function store(Request $request)
    {
        //
        $kategori = new kategori;
        $kategori->Nama_Kategori=$request->namakategori;
        $kategori->save();
        Session::flash('message', 'Kategori Berhasil Ditambah');

        return back();
    }
    public function edit(request $request)
    {
        //

        DB::table('kategoris')
        ->where('id', $request->id_kategori)
        ->update(['Nama_Kategori' => $request->namakategori]);
        Session::flash('message', 'Kategori Berhasil Diedit');
        return back();
  
    }
}
