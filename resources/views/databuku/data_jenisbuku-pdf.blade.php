<!DOCTYPE html>
<html>
<head>
    
<style>
#jenis {
  border-collapse: collapse;
  width: 100%;
}

#jenis td, #jenis th {
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
    <h3>Data Jenis Buku Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="jenis">
  <tr>
    <th> No </th>
    <th> Kode </th>
    <th> Jenis Buku </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $jenisbuku)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$jenisbuku->id}}</td>
        <td>{{$jenisbuku->nama}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>


