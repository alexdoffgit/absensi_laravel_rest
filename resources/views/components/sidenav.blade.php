<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-black d-flex flex-column" style="height: 100vh">
            <div class="mt-3">
                @foreach ($menus as $menu)
                    @if(empty($menu->menu_path))
                        <div class="text-white mb-1">{{ $menu->menu_name }}</div>
                    @else
                        <a href="{{ $menu->menu_path }}" class="text-white mb-3 ms-3">{{ $menu->menu_name }}</a><br/>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>