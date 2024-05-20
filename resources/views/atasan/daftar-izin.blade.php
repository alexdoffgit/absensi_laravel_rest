<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Izin</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Karyawan</th>
                <th>Department</th>
                <th>Jabatan</th>
                <th>Tipe Izin</th>
                <th>Tanggal Pengajuan Izin</th>
                <th>Tanggal Awal Izin</th>
                <th>Tanggal Akhir Izin</th>
                <th>Alasan Izin</th>
                <th>Dokumen Pendukung</th>
                <th>Persetujuan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semuaIzin as $data)
                <tr>
                    <td>{{ $data['nama_karyawan'] }}</td>
                    <td>{{ $data['department'] }}</td>
                    <td>{{ $data['jabatan'] }}</td>
                    <td>{{ $data['tipe_izin'] }}</td>
                    <td>{{ $data['tanggal_pengajuan'] }}</td>
                    <td>{{ $data['tanggal_mulai'] }}</td>
                    <td>{{ $data['tanggal_selesai'] }}</td>
                    <td>{{ $data['alasan'] }}</td>
                    <td> </td>
                    <td>
                        <a class="btn btn-success" href='{{ url("/{$atasanId}/atasan/{$data['id']}/accept") }}'>Accept</a> / <a class="btn btn-danger" href='{{ url("/{$atasanId}/atasan/{$data['id']}/reject") }}'>Reject</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>