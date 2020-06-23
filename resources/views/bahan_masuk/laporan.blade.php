<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <div style="padding-top:30px;" class="container-fluid">
        <center>
            <h2>Data Bahan Masuk</h2>
            <p>{{$awal}} - {{$akhir}}</p>
        </center>
        <form method="post" action="/pdf-bmasuk">
        @csrf
            <div style="display:none;">
                <input name="awal" type="date" value="{{$awal}}">
                <input name="akhir" type="date" value="{{$akhir}}">
            </div>  
            <button type="submit" class="btn btn-danger">Print</button><a style="margin-left:10px;" type="button" href="/buatlap-BMasuk" class="btn btn-secondary" >Kembali</a>
        </form>
        <table style="margin-top:10px;" class="table">
            <thead class="thead-light">
                <tr>
                    <th>Nama Makanan</th>
                    <th>Jumlah</th>
                    <th>Satuan</th>
                    <th>Tanggal Masuk</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                ?>
                @foreach ($laporan as $b)
                <tr>
                    <td>{{$b->Nama_Bahan}}</td>
                    <td>{{$b->Jumlah}}</td>
                    <td>{{$b->Satuan}}</td>
                    <td>{{$b->Tanggal_Masuk}}</td>
                    <td>{{$b->Harga}}</td>
                </tr>
                <?php
                    $total = $total + $b->Harga;
                ?>
                @endforeach
            </tbody>
        </table>
        <h4>TOTAL : {{ $total }}</h4>
    </div>

</body>

</html>
