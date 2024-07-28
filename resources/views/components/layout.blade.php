<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body class="absensi-layout-body">
    <div class="absensi-layout-container">
        <x-topnav />
        <div class="absensi-layout-main">
            <x-sidenav />
            {{ $slot }}
        </div>
    </div>
</body>
</html>