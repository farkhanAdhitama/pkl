<!DOCTYPE html>
<html>

<head>

    <style>
        #book {
            border-collapse: collapse;
            width: 100%;
        }

        #book td,
        #book th {
            border: 1px solid rgb(0, 0, 0);
            padding: 8px;
        }



        .judul {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="judul">
        <h3>Data Pengembalian Buku Siswa </h3>
        <p>Perpustakaan SMA Negeri 1 Kajen</p>
        <?php
        echo 'Dicetak Tanggal : ' . date('d-m-Y') . '<br>';
        ?>
        <br>
    </div>

    <table id="book">
        <tr>
            <th> No </th>
            <th> Nama </th>
            <th> Kelas </th>
            <th> Judul </th>
            <th> Tanggal Pinjam</th>
            <th> Tanggal Kembali </th>
            <th> Total </th>
            <th> Petugas</th>
        </tr>

        @php
            $no = 1;
        @endphp
        @foreach ($data as $row)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $row->anggota->nama ?? '' }}</td>
                <td>{{ $row->anggota->kelas ?? '' }}</td>
                <td>{{ $row->buku->judul_buku ?? '' }}</td>
                <td>{{ $row->getCreatedAttribute() }}</td>
                <td>{{ $row->getTanggalKembali() }}</td>
                <td>{{ $row->lama_peminjaman() }} Hari</td>
                <td>{{ $row->petugas ?? '' }}</td>

            </tr>
        @endforeach
    </table>

</body>

</html>
