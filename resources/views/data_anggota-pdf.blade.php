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
    <h3>Data Anggota Perpustakaan</h3>
    <p>SMA Negeri 1 Kajen</p>
</div>

<table id="member">
  <tr>
    <th> No </th>
    <th> Nama </th>
    <th> NIS/NIP </th>
    <th> Kelas/Jabatan </th>
    <th> Nomor HP </th>
    <th> Alamat </th>
  </tr>

  @php
      $no = 1;
  @endphp
  @foreach ($data as $anggota)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{$anggota->nama}}</td>
        <td>{{$anggota->nis}}</td>
        <td>{{$anggota->kelas}}</td>
        <td>{{$anggota->no_hp}}</td>
        <td>{{$anggota->alamat}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>


