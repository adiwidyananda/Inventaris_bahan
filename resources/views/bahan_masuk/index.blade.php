
        @extends('layout/main')

        @section('title','Bahan Masuk')

        @section('container')

        <center>
        <h2 style="margin-top:40px;">Data Bahan Masuk</h2>
    </center>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
        <div style="border-top:solid 1px rgba(0, 0, 0, .5);padding-top:40px;" class="container-fluid">          
            <div class="row">
                <div class="col-12 mt-4">
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Makanan</th>
                                <th>Jumlah</th>
                                <th>Satuan</th>
                                <th>Tanggal Masuk</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahan_masuk as $b)
                            <tr>
                                <td>{{$b->Nama_Bahan}}</td>
                                <td>{{$b->Jumlah}}</td>
                                <td>{{$b->Satuan}}</td>
                                <td>{{$b->Tanggal_Masuk}}</td>
                                <td>{{$b->Harga}}</td>
                                <span>
                                    <td>
                                        <button class="btn btn-secondary" id="edit" value="{{$b->id}}" data-toggle="modal" data-target=".modal{{ $b->id }} " style="padding-left: 23px; padding-right: 23px;">Edit</button><a href="/deleteBMasuk/{{ $b->id }}" style="margin-left:10px;"><button class="btn btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus bahan masuk ini?');">Delete</button></a>
                                        
                                    </td>
                                </span>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahmodal">Tambah</button>
                <a href='/buatlap-BMasuk'><button type="button" class="btn btn-success">Buat Laporan Data Masuk</button></a>
            </div>
        </div>

        <div class="modal fade" id="tambahmodal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center; padding-left: 150px;">Bahan Masuk</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <form action="/addBMasuk" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <select class="custom-select" id="nama_bahan" name="id_bahan" required>
                                            <option selected disabled>--Nama Bahan--</option>
                                            @foreach ($bahan as $w)
                                            <option value="{{$w->id}}">{{$w->Nama_Bahan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input min="1" type="text" class="form-control" id="Jumlah" placeholder="jumlah" name="jumlah" aria-describedby="basic-addon1"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="satuan" placeholder="Satuan"readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="total_harga" placeholder="total_harga" name="total_harga"/>
                                    </div>
                                    <div style="display:none" class="form-group">
                                        <input min="1" type="text" class="form-control" id="id_admin" placeholder="id_admin" name="id_admin" value="{{ Session::get('id') }}" />
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit" style="width: 100px; height: 50px; margin-right: 20px;">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Edit -->
        @foreach ($bahan_masuk as $b)
        <div class="modal fade modal{{ $b->id }}" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center; padding-left: 120px;">Edit Bahan Masuk</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 1px;">x</button>
                    </div>
                    <div class="modal-body" style="text-align: center;">
                        <form action="/editBMasuk" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <input style="display: none;" type="text" id="id_bahan" name="id_bahan" class="form-control" placeholder="{{$b->Nama_Bahan}}" aria-describedby="basic-addon1" value="{{$b->id}}" readonly/>
                                        <input type="text" id="nama_bahan" name="nama_bahan" class="form-control" placeholder="{{$b->Nama_Bahan}}" aria-describedby="basic-addon1" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input min="1" type="text" class="form-control" id="Jumlah" placeholder="{{$b->Jumlah}}" name="jumlah" aria-describedby="basic-addon1" required="" />
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="satuan" placeholder="{{$b->Satuan}}" value="{{$b->Satuan}}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="total_harga" placeholder="{{$b->Harga}}" name="total_harga" required="" />
                                    </div>
                                    <div style="display:none;" class="form-group">
                                        <input min="1" type="text" class="form-control" id="id_admin" placeholder="id_admin" name="id_admin" value="{{ Session::get('id') }}" readonly="" />
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-secondary" type="submit" style="width: 100px; height: 50px; margin-right: 20px;">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    <script>
        $(document).ready(function () {
            $('#bmasuk').css({"background-color":"white","color":"#274FC2"});
            $("#example").DataTable();
                $("#nama_bahan").change(function(){
                    $idb = $("#nama_bahan").val();
                    @foreach ($bahan as $w)
                    if({{$w->id}} == $idb){
                        $("#satuan").val("{{$w->Satuan}}");
                    }           
                    @endforeach
                });
            });

    </script>
    
  
</html>
@endsection
