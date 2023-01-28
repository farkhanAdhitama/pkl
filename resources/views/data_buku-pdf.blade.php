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
    <h3>Data Buku Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
    <?php
    echo "Dicetak Tanggal : " . date("d-m-Y") . "<br>";
    ?>
    <br>
</div>

<table id="book">
  <tr>
    <th> No </th>
    <th> Judul </th>
    <th> Penulis </th>
    <th> Penerbit </th>
    <th> Terbitan </th>
    <th> Jumlah </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $buku)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$buku->judul_buku}}</td>
        <td>{{$buku->penulis}}</td>
        <td>{{$buku->penerbit}}</td>
        <td>{{$buku->tahun_terbit}} </td>
        <td>{{$buku->jumlah}} </td>
    </tr>
    @endforeach
</table>

</body>
</html>


