@extends('layout/main')
@section('container')
    <center>
        <h2 style="margin-top:40px;"><a style="text-decoration:none;color:#212529;" href="/makanan">Data Makanan</a> > {{ $makanan->Nama_Makanan }}</h2>
    </center>
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div style="border-top:solid 1px rgba(0, 0, 0, .5);padding-top:40px;" class="container-fluid">
        <table id="example" class="display">
            <thead>
                <tr>
                    <th>Nama_Bahan</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Total_Harga</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody id="terisi">
                @foreach( $bahan_keluar as $bkr )
                <tr>
                    <td>{{ $bkr->Nama_Bahan }}</td>
                    <td>{{ $bkr->Jumlah }}</td>
                    <td>{{ $bkr->Satuan }}</td>
                    <td>{{ $bkr->Harga_Satuan }}</td>
                    <td>{{ $bkr->Harga_Total }}</td>
                    <td><a href="/deleteBKeluar/{{ $bkr->id }}"><button onclick="return confirm('Apa anda yakin menghapus bahan keluar ini ?');"
                                class="btn btn-danger">Delete</button></a><button id="editBut" value="{{ $bkr->id }}" style="margin-left:10px;" data-toggle="modal" data-target=".modal{{ $bkr->id }}"
                            class="btn btn-secondary">Edit</button></td>
                </tr>
                <div class="modal fade modal{{ $bkr->id }}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="padding:20px;" class="modal-content">
                <center>
                    <h2>Tambah User</h2>
                    </center>
                    <form id="form{{ $bkr->id }}" method="post" action="/editBKeluar">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                    <input name="namaedit" id="namaedit{{ $bkr->id }}" type="text" class="form-control"
                                        placeholder="Harga Satuan" value="{{ $bkr->Nama_Bahan }}" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input min="1" name="jumlahedit" id="jumlahedit{{ $bkr->id }}" type="text" class="form-control"
                                       value="{{ $bkr->Jumlah }}" placeholder="stock : {{ $bkr->Jumlah_Bahan }}" aria-label="Username" aria-describedby="basic-addon1"></br>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="satuan" id="satuanedit" type="text" class="form-control"
                                        placeholder="Satuan" value="{{ $bkr->Satuan }}" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="harga_satuan" id="harga_satuanedit{{ $bkr->id }}" type="text" class="form-control"
                                        placeholder="Harga Satuan" value="{{ $bkr->Harga_Satuan }}" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="harga_total" id="harga_totaledit{{ $bkr->id }}" type="text" class="form-control"
                                        placeholder="Harga Total" value="{{ $bkr->Harga_Total }}" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <input style="display:none;" name="id_makanan" value="{{ $bkr->id_makanan }}" type="text">
                                <input style="display:none;" name="id_bahan" value="{{ $bkr->id_bahan }}" type="text">
                                <input style="display:none;" name="id_BKeluar" value="{{ $bkr->id }}" type="text">
                                <p style="color:red">*bahan yang stocknya habis namanya tidak akan muncul pada list nama
                                    bahan</p>
                            </div>
                            <button id="editBut{{ $bkr->id }}" type="button" class="btn btn-secondary">Edit</button>
                        </div>
                        
                    </form>
                </div>
                <script>
                    $('#editBut{{ $bkr->id }}').click(function() {
                        if ({{ $bkr->Jumlah_Bahan }} < $('#jumlahedit{{ $bkr->id }}').val()) {
                        alert("Jumlah melebihi stok yang ada");
                        } else {
                        $('#form{{ $bkr->id }}').submit()
                        }   
                    });
                    $('#jumlahedit{{ $bkr->id }}').keyup(function () {
                        $total = $('#jumlahedit{{ $bkr->id }}').val() * $('#harga_satuanedit{{ $bkr->id }}').val()
                    $('#harga_totaledit{{ $bkr->id }}').val($total)
            })
                </script>
            </div>
        </div>
                @endforeach
            </tbody>
        </table>
        <button type="button" style="height:38px;" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah
            Bahan</button><a style="margin-left:10px;" href="/makanan" type="button" class="btn btn-secondary" >Kembali</a>

        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div style="padding:20px;" class="modal-content">
                    <center>
                        <h2>Tambah Bahan</h2>
                    </center>
                    <form id="form" method="post" action="/addBKeluar">
                        @csrf
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>
                                <select name="n_bahan" id="n_bahan" style="margin-bottom:20px;" class="custom-select"
                                    id="inputGroupSelect01">
                                    <option selected disabled>Nama Bahan</option>
                                    @foreach( $bahan as $bhn )
                                    @if ( $bhn->Jumlah > 0)
                                    <option value="{{ $bhn->id }}">{{ $bhn->Nama_Bahan }}</option>
                                    @endif
                                    @endforeach
                                </select>
                                <div class="input-group mb-3">
                                    <input min="1" name="jumlah" id="jumlah" type="text" class="form-control"
                                        placeholder="Jumlah" aria-label="Username" aria-describedby="basic-addon1"></br>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="satuan" id="satuan" type="text" class="form-control"
                                        placeholder="Satuan" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="harga_satuan" id="harga_satuan" type="text" class="form-control"
                                        placeholder="Harga Satuan" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="harga_total" id="harga_total" type="text" class="form-control"
                                        placeholder="Harga Total" aria-label="Username" aria-describedby="basic-addon1"
                                        readonly>
                                </div>
                                <p style="color:red">*bahan yang stocknya habis namanya tidak akan muncul pada list nama
                                    bahan</p>
                                <input style="display:none" name="id_makanan" id="id_makanan" value="{{ $makanan->id }}"
                                    type="text">
                                <input style="display:none" name="id_bahan" id="id_bahan" type="text">
                            </div>
                        </div>
                        <button id="subForm" type="button" class="btn btn-success">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#bkeluar').css({"background-color":"white","color":"#274FC2"});
            $('#n_bahan').change(function () {
                $idn = $('#n_bahan').val();
                @foreach($bahan as $bhn)
                if ({{$bhn->id}} == $idn) {
                    $('#satuan').val('{{ $bhn->Satuan }}')
                    $('#harga_satuan').val({{$bhn->Harga_Satuan}})
                    $('#id_bahan').val({{$bhn->id}})
                    $('#jumlah').attr("placeholder", "stock : {{ $bhn->Jumlah }}")
                    $jumlah = {{$bhn->Jumlah}}
                    $('#jumlah').attr("max", $jumlah)
                }
                @endforeach
            });
            $('#jumlah').keyup(function () {
                $total = $('#jumlah').val() * $('#harga_satuan').val()
                $('#harga_total').val($total)
            })
            $('#subForm').click(function () {
                if ($jumlah < $('#jumlah').val()) {
                    alert("Jumlah melebihi stok yang ada");
                } else {
                    $('#form').submit()
                }
            });
        });

    </script>
@endsection
