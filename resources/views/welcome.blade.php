<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Aplikasi Absensi</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <style>
            .layout-container {
                display: grid;
                grid-template-columns: repeat(12, 1fr);
            }
            .nav-container {
                grid-column: span 2 / span 2;
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
        </div>
    </body>
</html>
