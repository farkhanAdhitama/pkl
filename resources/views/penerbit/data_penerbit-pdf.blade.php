<!DOCTYPE html>
<html>
<head>
    
<style>
#penerbit {
  border-collapse: collapse;
  width: 100%;
}

#penerbit td, #penerbit th {
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
    <h3>Data Penerbit Buku Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="penerbit">
  <tr>
    <th> No </th>
    <th> Kode </th>
    <th> Nama Penerbit </th>
    <th> Alamat </th>
    <th> Kota </th>

  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $penerbit)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$penerbit->id}}</td>
        <td>{{$penerbit->nama_penerbit}}</td>
        <td>{{$penerbit->alamat}}</td>
        <td>{{$penerbit->kota}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>


