<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-black d-flex flex-column" style="height: 100vh">
                @foreach ($menu as $group => $subMenus)
                    <div class="text-white">{{ $group }}</div>
                    @foreach ($subMenus as $oneMenu)
                        <div class="ms-3 text-white">{{ $oneMenu->menu_name }}</div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>