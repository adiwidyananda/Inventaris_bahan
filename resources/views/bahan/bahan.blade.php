@extends('layout/main')

@section('title','Bahan')

@section('container')

<center>
    <h2 style="margin-top:40px;">Data Bahan</h2>
</center>
@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
<div style="border-top:solid 1px rgba(0, 0, 0, .5);padding-top:40px;" class="container-fluid">

    <div class="content-table" style="margin:5%; margin-top:0%;">
        <table id="example" class="table table-striped table-bordered">
            <thead>
                <tr>

                    <th scope="col">Nama Bahan</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bahan as $bhn)
                <tr>
                    <td>{{ $bhn->Nama_Bahan }}</td>
                    <td>{{ $bhn->Nama_Kategori}}</td>
                    <td>{{ $bhn->Jumlah }}</td>
                    <td>{{ $bhn->Satuan }}</td>
                    <td>{{ $bhn->Harga_Satuan }}</td>
                    <td>
                        <!-- button delete -->
                        <a style="margin-left:10px;" onclick="return confirm('Apa anda yakin menghapus bahan ini ?');" href="deleteBahan/{{ $bhn->id }}">
                            <button class="btn btn-danger">Delete</button></a>

                        <!-- button edit -->
                        <button type="button" style="margin-left:10px;" data-target=".modal{{$bhn->id}}"
                            data-toggle="modal" value="#" class="btn btn-secondary">Edit</button>
                        <div class="modal fade modal{{$bhn->id}}" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content" style="padding:20px; margin-left:50px">
                                    <h3>Edit Bahan</h3>
                                    <!-- form untuk edit bahan -->
                                    <form method="POST" action="/editBahan">
                                        @csrf
                                        <div class="form-group">
                                            <label for="namabahan">Nama Bahan</label>
                                            <input type="text" class="form-control" name=namabahan id="namabahan"
                                                aria-describedby="emailHelp" value="{{$bhn->Nama_Bahan}}">
                                            <input style="display:none;" type="text" class="form-control" name=id_bahan
                                                id="id_bahan" aria-describedby="emailHelp" value={{$bhn->id}}>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategoribahan">Nama Kategori</label>
                                            <input type="text" class="form-control" name=kategoribahan
                                                id="kategoribahan" aria-describedby="emailHelp"
                                                value="{{$bhn->Nama_Kategori}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlahbahan">Jumlah</label>
                                            <input type="text" class="form-control" name=jumlahbahan id="jumlahbahan"
                                                aria-describedby="emailHelp" value="{{$bhn->Jumlah}}" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="hargabahan">Satuan</label>
                                            <input type="text" class="form-control" name=satuanbahan id="satuanbahan"
                                                aria-describedby="emailHelp" value="{{$bhn->Satuan}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="hargabahan">Harga Satuan</label>
                                            <input type="text" class="form-control" name=hargabahan id="hargabahan"
                                                aria-describedby="emailHelp" value="{{$bhn->Harga_Satuan}}">
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <button type="submit" class="btn btn-secondary"
                                                    style="width: 100px; height: 40px;margin-left:20px; margin-top:-20px;">Edit</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah
        Bahan</button>
        <a href="/pdf-bahan"><button type="button" class="btn btn-success">Print</button></a>

    </div>

    

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding:20px; margin-left:50px">
                <center>
                    <h2>Tambah Bahan</h2>
                </center>
                <!-- form untuk tambah bahan -->
                <form method="POST" action="/addBahan">
                    @csrf
                    <label for="exampleInputEmail1">Nama Kategori</label>
                    <select name="id_kategori" id="idkategori" style="margin-bottom:20px;" class="custom-select"
                        id="inputGroupSelect01">
                        <option selected disable>Masukkan Nama Kategori</option>
                        @foreach( $kategori as $ktr )

                        <option value="{{ $ktr->id }}">{{ $ktr->Nama_Kategori }}</option>

                        @endforeach
                    </select>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Bahan</label>
                        <input type="text" class="form-control" name=namabahan id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Nama Bahan">
                    </div>
                    <div style="display:none;" class="form-group">
                        <label for="exampleInputEmail1">Jumlah</label>
                        <input value="0" type="text" class="form-control" name=jumlahbahan id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Jumlah Bahan">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Satuan</label>
                        <input type="text" class="form-control" name=satuanbahan id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Satuan Bahan">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Harga Satuan</label>
                        <input type="text" class="form-control" name=hargabahan id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Masukkan Harga Bahan">
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-xs-8">
                            <button type="submit" class="btn btn-success"
                                style="width: 100px; height: 40px;margin-left:20px; ">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#bahan').css({
            "background-color": "white",
            "color": "#274FC2"
        });
    });

</script>
@endsection
