<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kehadiran</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .layout-container {
        height: 100vh;
        display: grid;
        grid-template-columns: repeat(12, 1fr);
    }
    .sidenav-container {
        grid-column: span 2 / span 2;
    }
    .content-container {
        grid-column: span 10 / span 10;
        display: grid;
        grid-template-columns: repeat(10, 1fr);
    }
    .pseudo-padding {
        grid-column-start: 2;
        grid-column-end: 10;
    }
    .presence-table-overflow-wrapper, .absence-table-overflow-wrapper {
        overflow-x: auto; 
    }
    tr th {
        background-color: #1B1B1B;
        color: white;
        padding: .8em;
    }
    tr td {
        padding: .8em;
    }
    tr:nth-of-type(even) td {
        padding: .8em;
        background-color: #DADADA;
    }
</style>
<body>
    <div class="layout-container">
        <div class="sidenav-container">
            @if($position == 'staff')
                <x-nav-karyawan :$karyawanId />
            @elseif ($position == 'atasan')
                <x-nav-atasan :$karyawanId />
            @elseif ($position == 'hr')
                <x-nav-hr :$karyawanId />
            @else

            @endif
        </div>
        <div class="content-container">
            <div class="pseudo-padding">
                <h1>Kehadiran</h1>
                <h2>Presensi</h2>
                <div class="presence-table-overflow-wrapper">
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <th style="text-align: right;">Jam Masuk</th>
                                <th style="text-align: right;">Jam Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presenceTableData as $row)
                                <tr>
                                    <td>{{ $row['tanggal'] }}</td>
                                    <td style="text-align: right;">{{ $row['jam_masuk'] }}</td>
                                    <td style="text-align: right;">{{ $row['jam_pulang'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h2>Absensi</h2>
                <div class="absence-table-overflow-wrapper">
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <th style="text-align: right;">Jam Masuk</th>
                                <th style="text-align: right;">Jam Keluar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($absenceTableData as $row)
                                <tr>
                                    <td>{{ $row['tanggal'] }}</td>
                                    <td style="text-align: right;">{{ $row['jam_masuk'] }}</td>
                                    <td style="text-align: right;">{{ $row['jam_pulang'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>