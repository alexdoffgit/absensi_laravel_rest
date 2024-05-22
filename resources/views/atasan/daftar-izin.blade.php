<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Izin</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .full-body-wrapper {
            height: 100vh;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .full-body-wrapper > h1 {
            margin-top: 2rem;
            margin-bottom: 0;
        }
        .full-body-wrapper > div.filter {
            margin-top: 3rem;
            display: flex;
            align-items: center;
            gap: 0.5em;
        }
        .table-overflow-wrapper {
            margin-top: 1rem;
            overflow-x: auto;
        }
        table {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            padding-top: 8px;
            padding-bottom: 8px; 
        }
        th {
            background-color: black;
            color: white;
        }
        tr:nth-child(odd) {
            background-color: #dadada;
        }
        .accept-reject {
            display: flex;
        }
        .accept-reject > a {
            text-decoration: none;
        }
        .accept-reject > a.accept {
            background-color: var(--bs-form-valid-color);
            padding: 6px;
            color: white;
        }
        .accept-reject > a.reject {
            background-color: var(--bs-form-invalid-color);
            padding: 6px;
            color: white;
        }
    </style>
</head>
<body>
    <div class="full-body-wrapper">
        <h1>Persetujuan Izin</h1>
        <div class="filter">
            <input type="search" name="gsearch" id="gsearch">
            <button class="btn btn-primary">Minggu Ini</button>
            <button class="btn btn-primary">Bulan Ini</button>
            <button class="btn btn-primary">Filter Ini</button>
        </div>
        <div class="table-overflow-wrapper">
            <table style="width: 160%">
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
                                <div class="accept-reject">
                                    <a class="accept" href='{{ url("/{$atasanId}/atasan/{$data['id']}/accept") }}'>Accept</a>
                                    <a class="reject" href='{{ url("/{$atasanId}/atasan/{$data['id']}/reject") }}'>Reject</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>