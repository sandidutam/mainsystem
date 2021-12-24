<h1>Data Presensi</h1>

<table class="table">
    <thead>
        <tr style="background-color: black; color: white;">
            <th>Tanggal</th>
            <th>Nomor Pegawai</th>
            <th>Nama Lengkap</th>
            <th>Sektor</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
            {{-- <th>Catatan</th> --}}
            <th>Ket</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presensi as $p)
        <tr>
            <td>{{date('d F Y', strtotime($p->tanggal))}}</td>
            <td>{{$p->pegawai->nomor_pegawai}}</td>
            <td>{{$p->pegawai->nama_lengkap()}}</td>
            <td>{{$p->pegawai->sektor_area}}</td>
            <td>{{$p->jam_masuk}}</td>
            <td>{{$p->jam_keluar}}</td>
            {{-- <td>{{$p->catatan()}}</td> --}}
            <td>{{$p->keterangan}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
