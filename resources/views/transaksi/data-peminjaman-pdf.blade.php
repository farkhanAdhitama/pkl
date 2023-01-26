<!DOCTYPE html>
<html>
<head>
    
<style>
#book {
  border-collapse: collapse;
  width: 100%;
}

#book td, #book th {
  border: 1px solid rgb(0, 0, 0);
  padding: 8px;
}



.judul{
    text-align: center;
}

</style>
</head>
<body>

<div class="judul">
    <h3>Data Peminjaman Buku Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
    <?php
    echo "Dicetak Tanggal : " . date("d-m-Y") . "<br>";
    ?>
    <br>
</div>

<table id="book">
  <tr>
    <th> No </th>
    <th> Nama </th>
    <th> Judul </th>
    <th> Tanggal Pinjam</th>
    <th> Tenggat Waktu </th>
    <th> Lama </th>
    <th> Denda </th>
    <th> Status </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $row)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$row->anggota->nama ?? ''}} ({{ $row->anggota->kelas ?? ''}})</td>
        <td>{{$row->buku->judul_buku ?? ''}}</td>
        <td>{{$row-> getCreatedAttribute()}}</td>
        <td>{{$row->getTenggatWaktu($row->lama)}}</td>
        <td>{{$row->lama}}Hari</td>
        <td>{{$row->getDenda($row->lama)}} </td>
        <td>{{$row->status}} </td>
    </tr>
    @endforeach
</table>

</body>
</html>


