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
    <h3>Data CD Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="penerbit">
  <tr>
    <th> Kode Kelompok </th>
    <th> Judul </th>
    <th> Perolehan </th>
    <th> Jumlah </th>

  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $cd)
    <tr>
        <td>{{$cd->kode_kelompok}}</td>
        <td>{{$cd->judul_cd}}</td>
        <td>{{$cd->perolehan}}</td>
        <td>{{$cd->jumlah}}</td>

    </tr>
    @endforeach
</table>

</body>
</html>


