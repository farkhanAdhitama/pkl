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
    <h3>Data Majalah Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="penerbit">
  <tr>
    <th> Nama </th>
    <th> Tanggal Terbit </th>
    <th> Nomor/Volume/Tahun </th>
    <th> ISSN </th>
    <th> Jumlah </th>

  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $majalah)
    <tr>
        <td>{{$majalah->nama}}</td>
        <td>{{$majalah->tanggal_terbit}}</td>
        <td>{{$majalah->nomor}}/{{$majalah->volume}}/{{$majalah->tahun}}</td>
        <td>{{$majalah->issn}}</td>
        <td>{{$majalah->jumlah}}</td>

    </tr>
    @endforeach
</table>

</body>
</html>


