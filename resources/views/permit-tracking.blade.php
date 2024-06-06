<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permit Tracking</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .layout-container {
            height: 100vh;
            display: grid;
            grid-template-columns: repeat(12, 1fr);
        }
        .nav-container {
            grid-column: span 2 / span 2;
        }
        .content-container {
            grid-column: span 10 / span 10;
            display: grid;
            grid-template-columns: repeat(10, 1fr);
        }
        .pseudo-padding {
            margin: 3rem 0;
            grid-column: 2 / 10;
            dis
        }
        .leave-card {
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: #E6E5E5;
            border-radius: 12px;
            width: 15%;
        }
        .leave-card > p {
            text-align: center;
        }
        .leave-card > p:first-child {
            margin-bottom: .5rem;
        }
        .leave-card > p:last-child {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0;
        }
        table {
            margin-top: 1.5rem;
        }
        tr th {
            background-color: #1B1B1B;
            color: white;
            padding: .625rem;
        }
        tr:nth-child(even) td {
            background-color: #D5D2D2;
        }
        tr td {
            padding: .625rem;
        }
    </style>
</head>
<body>
    <div class="layout-container">
        <div class="nav-container">
            @if($jabatan == 'staff')
                <x-nav-karyawan :$karyawanId />
            @elseif ($jabatan == 'atasan')
                <x-nav-atasan :$karyawanId />
            @elseif ($jabatan == 'hr')
                <x-nav-hr :$karyawanId />
            @else
    
            @endif
        </div>
        <div class="content-container">
            <div class="pseudo-padding">
                <h1>Permit Tracking</h1>
                <div class="leave-card">
                    <p>Jatah Cuti</p>
                    <p>11</p>
                </div>
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-primary">Minggu Ini</button>
                    <button class="btn btn-primary">Bulan Ini</button>
                    <button class="btn btn-primary">
                        <i class="bi bi-funnel-fill"></i>
                        Filter
                    </button>
                    <button class="btn btn-primary">
                        <i class="bi bi-download"></i>
                        Download Report
                    </button>
                </div>
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <th>Tipe Izin</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permitSummaryMatrix as $row)
                            <tr>
                                <td>{{ $row['tipe_izin'] }}</td>
                                <td>{{ $row['tanggal_pengajuan'] }}</td>
                                <td>
                                    <a href="{{ url("/{$karyawanId}/{$row['id']}/tracking-detail") }}">
                                        Link To Detail
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>