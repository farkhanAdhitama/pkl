<!DOCTYPE html>
<html>
<head>
    
<style>
#book {
  border-collapse: collapse;
  width: 100%;
}

#book td, #book th {
  border: 1px solid #ddd;
  padding: 8px;
}

#book tr:nth-child(even){background-color: #f2f2f2;}

#book tr:hover {background-color: #ddd;}

#book th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #b1b0b3;
  color: white;
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
</div>

<table id="book">
  <tr>
    <th> No </th>
    <th> Judul </th>
    {{-- <th> ISBN </th> --}}
    <th> Kategori </th>
    <th> Jenis Buku</th>
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
        {{-- <td>{{$buku->isbn}}</td> --}}
        <td>{{$buku->kategori}}</td>
        <td>{{$buku->jenis_buku}}</td>
        <td>{{$buku->penulis}}</td>
        <td>{{$buku->penerbit}}</td>
        <td>{{$buku->tahun_terbit}} </td>
        <td>{{$buku->jumlah}} </td>
    </tr>
    @endforeach
</table>

</body>
</html>


