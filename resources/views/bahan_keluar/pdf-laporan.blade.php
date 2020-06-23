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
            <h2>Data Bahan Keluar</h2>
            <p style="margin-bottom:40px;">{{$awal}} - {{$akhir}}</p>
        </center>
        <?php
                $total = 0;
        ?>
        @foreach ($makanan as $m)
            
            <center><h4>Makanan : {{$m->Nama_Makanan}}</h4><p>Tanggal : {{$m->Tanggal_Keluar}} Total : {{$m->Harga}}</p></center>
            
            <table style="margin-top:10px;border-bottom:solid 2px grey;margin-bottom:20px;" class="table">
                <thead class="thead-light">
                <tr>
                        <th>Nama_Bahan</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total_Harga</th>
                    </tr>
                </thead>
            
                <tbody>
                @foreach ($bahan_keluar as $b)   
                    @if ($m->id == $b->id_makanan)  
                    <tr>
                        <td>{{ $b->Nama_Bahan }}</td>
                        <td>{{ $b->Jumlah }}</td>
                        <td>{{ $b->Satuan }}</td>
                        <td>{{ $b->Harga_Satuan }}</td>
                        <td>{{ $b->Harga_Total }}</td>
                    </tr>
                    @endif
                    
                @endforeach
            </tbody>
        </table>
        <?php
            $total = $total + $m->Harga;
        ?> 
        @endforeach
        <h4>TOTAL : {{ $total }}</h4>
    </div>

</body>

</html>
