<div class="container-fluid">
    <div class="row">
        <div class="col-2 bg-black d-flex flex-column" style="height: 100vh">
            <div class="mt-3">
                @foreach ($menus as $menu)
                    @if (property_exists($menu, 'children'))
                            <div 
                             class="text-white mb-1" 
                             aria-expanded="false" 
                             style="cursor: pointer;"
                             data-bs-toggle="collapse" 
                             aria-controls="{{ $menu->menu_name }}Collapse"
                             data-bs-target="#{{ $menu->menu_name }}Collapse">
                                {{ $menu->menu_name }}
                            </div>
                            <div
                             class="collapse"
                             id="{{ $menu->menu_name }}Collapse">
                                @foreach ($menu->children as $c1)
                                    <a href="#" class="text-white d-block ms-3">{{ $c1->menu_name }}</a>
                                @endforeach
                            </div>
                        @else
                            <a href="#" class="text-white d-block">{{ $menu->menu_name }}</a>
                        @endif
                @endforeach
            </div>
        </div>
    </div>
</div>