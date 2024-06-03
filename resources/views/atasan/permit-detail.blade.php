<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Permit Detail - {{ $permit['nama_karyawan'] }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .layout-container {
            height: 100%;
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
        .pseudo-margin {
            grid-column-start: 2;
            grid-column-end: 10;
        }
        .pretty-box {
            margin-top: 3em;
            margin-bottom: 3em;
            padding: 2em;
            border: 1px solid #7e7c7c
        }
        a#accept-link, a#reject-link {
            text-decoration: none;
        }
        a#accept-link {
            background-color: var(--bs-success);
            padding: .4em;
            color: white;
        }
        a#reject-link {
            background-color: var(--bs-danger);
            padding: .4em;
            color: white;
        }
    </style>
</head>
<body>
    <div class="layout-container">
        <div class="nav-container">
            <x-nav-atasan karyawan-id="$penanggungJawabId" />
        </div>
        <div class="content-container">
            <div class="pseudo-margin">
                <div class="pretty-box">
                    <div class="row mb-3">
                        <span class="col-2">Nama Karyawan</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['nama_karyawan'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Departemen</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['department'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Tipe Izin</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['tipe_izin'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Tanggal Pengajuan</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['tanggal_pengajuan'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Tanggal Mulai</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['tanggal_mulai'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Tanggal Selesai</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['tanggal_selesai'] }}</span>
                    </div>
                    <div class="row mb-3">
                        <span class="col-2">Alasan</span>
                        <span class="col-1">:</span>
                        <span class="col-9">{{ $permit['alasan'] }}</span>
                    </div>
                    <div>
                        <a href="{{ url("/$penanggungJawabId/atasan/$id/accept") }}" id="accept-link">Accept</a>
                        <a href="{{ url("/$penanggungJawabId/atasan/$id/reject") }}" id="reject-link">Reject</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>