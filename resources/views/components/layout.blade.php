<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{ $viteSlot ?? null }}
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 g-0">
                <x-sidenav />
            </div>
            <div class="col-10 g-0">
                <x-top-nav :$empName />
                {{ $slot }}
            </div>
        </div>
    </div>
</body>
{{ $script ?? null }}
</html>