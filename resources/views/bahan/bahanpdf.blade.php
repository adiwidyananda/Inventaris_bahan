<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div style="padding-top:30px;" class="container-fluid">
        <center><h2>Data Bahan</h2></center>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Bahan</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                ?>
                @foreach($bahan as $bhn)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $bhn->Nama_Bahan }}</td>
                    <td>{{ $bhn->Nama_Kategori}}</td>
                    <td>{{ $bhn->Jumlah }}</td>
                    <td>{{ $bhn->Satuan }}</td>
                    <td>{{ $bhn->Harga_Satuan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
