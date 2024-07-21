<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Interfaces\Menu;
use Illuminate\Support\Facades\DB;

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
            $user = DB::table('userinfo')
                ->where('USERID', '=', $userId)
                ->select('DEFAULTDEPTID')
                ->first();
            $menuTree = $this->menu->getMenuStructure(['deptId' => $user->DEFAULTDEPTID]);
        } else {
            $menuTree = $this->menu->getMenuStructure(['dlevel' => 4.0]);
        }

        return view('components.sidenav', ['menus' => $menuTree]);
    }
}
