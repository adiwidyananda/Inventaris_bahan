@extends('layout/main')

@section('title','Bahan Masuk')

@section('container')
    <div style="padding-top:30px;" class="container-fluid" action="/lap-bmasuk"> 
        <center><h2>Laporan Bahan Masuk</h2></center>
        <form method="post" id="form" style="margin-bottom:20px;" action="/lap-bmasuk">
            @csrf
            <div class="form-group">
              <label for="exampleInputPassword1">Tanggal Awal</label>
              <input type="date" class="form-control" id="awal" name="awal" placeholder="Masukkan Tanggal Awal">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tanggal Akhir</label>
                <input type="date" class="form-control" id="akhir" name="akhir" placeholder="Masukkan Tanggal Akhir">
            </div>
            <button type="button" id="sublaporan" class="btn btn-primary">Submit</button><a style="margin-left:10px;" type="button" href="/bahan_masuk" class="btn btn-secondary" >Kembali</a>
          </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#bmasuk').css({"background-color":"white","color":"#274FC2"});
            $('#sublaporan').click(function() {
                if ($('#awal').val() > $('#akhir').val()){
                    alert("Tanggal awal melewati tanggal akhir");
                } else {
                    $('#form').submit();
                }
            })
            });

    </script>
@endsection