<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-black d-flex flex-column" style="height: 100vh">
            <div>
                @foreach ($menus as $menu)
                    @if(empty($menu->menu_path))
                        <p class="text-white">{{ $menu->menu_name }}</p>
                    @else
                        <a href="{{ $menu->menu_path }}" class="text-white">{{ $menu->menu_name }}</a><br/>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>