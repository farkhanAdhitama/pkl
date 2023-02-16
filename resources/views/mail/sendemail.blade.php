<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .buku {
            font-weight: bold
        }
    </style>
</head>

<body>


    <div class="h4 buku">Masa Peminjaman Telah Habis</div><br>
    Dear {!! $data_email['nama'] !!},
    <br>
    <div>
        Masa Peminjaman <span class="fw-bold buku">{!! $data_email['berkas'] !!}</span>
        telah melewati tenggat waktu peminjaman pada {!! $data_email['tenggat'] !!}.
        <br>
        Mohon segera lakukan pengembalian ke Perpustakaan SMA Negeri 1 Kajen
    </div>
    <div>
        <br><br>
        TTD
        <br>
        Perpustakaan SMA Negeri 1 Kajen
    </div>


</body>

</html>
