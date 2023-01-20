<!DOCTYPE html>
<html>
<head>
    
<style>
#jenis {
  border-collapse: collapse;
  width: 100%;
}

#jenis td, #jenis th {
  border: 1px solid #ddd;
  padding: 8px;
}

#jenis tr:nth-child(even){background-color: #f2f2f2;}

#jenis tr:hover {background-color: #ddd;}

#jenis th {
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
    <h3>Data Jenis Buku Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="jenis">
  <tr>
    <th> No </th>
    <th> Jenis Buku </th>
    <th> Rak </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $jenisbuku)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$jenisbuku->nama}}</td>
        <td>{{$jenisbuku->rak}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>


