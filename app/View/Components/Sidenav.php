<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Interfaces\Menu;

class Sidenav extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        private Menu $menu
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $userId = session()->get('userId');
        if (!empty($userId)) {
            $menus =  $this->menu->getMenuStructure(['userId' => $userId]);
        } else {
            $menus =  [];
        }

        return view('components.sidenav', ['menus' => $menus]);
    }
}
