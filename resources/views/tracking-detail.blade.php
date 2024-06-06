<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tracking Detail - </title>
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
        .custom-flex {
            display: flex;
            margin-top: 1rem;
        }
        .custom-flex:first-of-type {
            margin-top: 1.5rem;
        }
        .col-colname {
            flex: 0 0 20%;
        }
        .col-double-colon {
            flex: 0 0 5%;
        }
        .col-desc {
            flex: 1 0 auto;
        }
        .section-atasan, .section-hr {
            margin-top: 1rem;
        }
        .section-atasan > .custom-flex {
            margin-left: 1.3rem;
        }
        .section-hr > .custom-flex {
            margin-left: 1.3rem;
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
                <h1>Izin #{{ $permitDetail['id'] }}</h1>
                <div class="custom-flex">
                    <span class="col-colname">Tipe Izin</span>
                    <span class="col-double-colon">:</span>
                    <span class="col-desc">{{ $permitDetail['tipe_absensi'] }}</span>
                </div>
                <div class="custom-flex">
                    <span class="col-colname">Tanggal Pengajuan</span>
                    <span class="col-double-colon">:</span>
                    <span class="col-desc">{{ $permitDetail['tanggal_pengajuan'] }}</span>
                </div>
                <div class="custom-flex">
                    <span class="col-colname">Tanggal Awal</span>
                    <span class="col-double-colon">:</span>
                    <span class="col-desc">{{ $permitDetail['tanggal_mulai'] }}</span>
                </div>
                <div class="custom-flex">
                    <span class="col-colname">Tanggal Akhir</span>
                    <span class="col-double-colon">:</span>
                    <span class="col-desc">{{ $permitDetail['tanggal_selesai'] }}</span>
                </div>
                <div class="custom-flex">
                    <span class="col-colname">Alasan</span>
                    <span class="col-double-colon">:</span>
                    <span class="col-desc">{{ $permitDetail['alasan'] }}</span>
                </div>
                @if (count($permitDetail['atasan']) > 0)
                    <div class="section-atasan">
                        <div>Atasan</div>
                        @foreach ($permitDetail['atasan'] as $atasanData)
                          <div class="custom-flex">
                            <span class="col-colname">Nama</span>
                            <span class="col-double-colon">:</span>
                            <span class="col-desc">{{ $atasanData['nama'] }}</span>
                          </div>
                          <div class="custom-flex">
                            <span class="col-colname">Status</span>
                            <span class="col-double-colon">:</span>
                            <span class="col-desc">{{ $atasanData['status'] }}</span>
                          </div> 
                        @endforeach
                    </div>
                @endif
                @if (count($permitDetail['hr']) > 0)
                    <div class="section-hr">
                        <div>HR</div>
                        @foreach ($permitDetail['hr'] as $hrData)
                          <div class="custom-flex">
                            <span class="col-colname">Nama</span>
                            <span class="col-double-colon">:</span>
                            <span class="col-desc">{{ $hrData['nama'] }}</span>
                          </div>
                          <div class="custom-flex">
                            <span class="col-colname">Status</span>
                            <span class="col-double-colon">:</span>
                            <span class="col-desc">{{ $hrData['status'] }}</span>
                          </div>
                        @endforeach
                    </div>
                @endif
                <button class="btn btn-danger mt-3">Batal Izin</button>
            </div>
        </div>
    </div>
</body>
</html>