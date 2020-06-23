@extends('/layout/main')
@section('container')
    <center>
        <h2 style="margin-top:40px;">Data Makanan</h2>
    </center>
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div style="border-top:solid 1px rgba(0, 0, 0, .5);padding-top:40px;" class="container-fluid">
        <table id="example" class="display">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $makanan as $mkn )
                <tr>
                    <td>{{ $mkn->Nama_Makanan }}</td>
                    <td>{{ $mkn->Harga }}</td>
                    <td>{{ $mkn->Tanggal_Keluar}}</td>
                    <td><a href="/detailMakanan/{{ $mkn->id }}"><button class="btn btn-success">Detail</button></a><a
                            style="margin-left:10px;" href="/deleteMakanan/{{ $mkn->id }}"><button onclick="return confirm('Apa anda yakin menghapus makanan ini ?');"
                                class="btn btn-danger">Delete</button></a><button id="butEdit" style="margin-left:10px;"
                            data-target=".modal1" data-toggle="modal" value="{{ $mkn->id }}" class="btn btn-secondary">Edit</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah
            Makanan</button><a style="margin-left:5px;" href='/buatlap-BKeluar'><button type="button" class="btn btn-success">Buat Laporan Data Keluar</button></a>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="padding:20px;" class="modal-content">
                    <center>
                        <h2>Tambah Makanan</h2>
                    </center>
                    <form method="post" action="/addMakanan">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Makanan</label>
                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Makanan">
                            <input style="display:none" value="0" type="text" name="harga" class="form-control"
                                placeholder="Masukkan Nama Makanan">
                            <input style="display:none" value="{{ Session::get('id') }}" type="text" name="id_admin"
                                class="form-control" placeholder="Masukkan Nama Makanan">
                        </div>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="padding:20px;" class="modal-content">
                    <center>
                        <h2>Data Makanan > Edit</h2>
                    </center>
                    <form method="post" action="/editMakanan">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Makanan</label>
                            <input id="nama" type="text" name="nama" class="form-control" placeholder="Masukkan Nama Makanan">
                            <input id="id" style="display:none" type="text" name="id"
                                class="form-control">
                        </div>
                        <button type="submit" class="btn btn-success">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#bkeluar').css({"background-color":"white","color":"#274FC2"});
            $('#butEdit').click(function() {
                $idm = $('#butEdit').val();
                @foreach( $makanan as $mkn )
                    if ({{ $mkn->id }} == $idm) {
                        $('#nama').val('{{ $mkn->Nama_Makanan }}');
                        $('#id').val($idm);
                    }
                @endforeach
            });
        });

    </script>
@endsection

