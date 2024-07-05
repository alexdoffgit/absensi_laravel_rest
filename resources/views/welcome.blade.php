<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Aplikasi Absensi</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        </style>
    </head>
    <body>
        <div>{{ $userId }}</div>
        <div>This is default page</div>
    </body>
</html>
