<!DOCTYPE html>
<html>
<head>
    
<style>
#member {
  border-collapse: collapse;
  width: 100%;
}

#member td, #member th {
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
    <h3>Data Guru Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="member">
  <tr>
    <th> No </th>
    <th> Nama </th>
    <th> NIK </th>
    <th> Jabatan </th>
    <th> Berlaku Sampai </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $anggota)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$anggota->nama}}</td>
        <td>{{$anggota->nik}}</td>
        <td>{{$anggota->jabatan}}</td>
        <td>{{$anggota->getMasaBerlaku}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>


