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
    {{-- <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-black d-flex flex-column" style="height: 100vh">
                @foreach ($menus as $menu)
                    @if (count($menu->menu_name) > 1)
                        @php
                            $offset = 0;
                            $lastLink = count($menu->menu_name) - 1;
                        @endphp
                        @foreach ($menu->menu_name as $i => $menuName)
                            @if ($i == $lastLink)
                                <a class="text-white ms-menu-{{ $offset }}" href="{{ action([$menu->laravel_controller_class, $menu->laravel_controller_method], ['uid' => 1]) }}" style="text-decoration: none;">
                                    {{ $menuName }}
                                </a>    
                            @else
                                <div class="text-white ms-menu-{{ $offset }}">{{ $menuName }}</div>
                            @endif
                            @php($offset += 1)
                        @endforeach
                    @endif
                @endforeach
            </div>
        </div>
    </div> --}}
    <x-sidenav />
</body>
</html>