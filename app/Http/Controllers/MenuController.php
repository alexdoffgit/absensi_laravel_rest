<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use App\Interfaces\Menu;

class MenuController extends Controller
{
    public function __construct(private Menu $menu) {}

    public function getMenus()
    {
        $userId = session()->get('userId');
        if (!empty($userId)) {
            $user = DB::table('users')
                ->where('USERID', '=', $userId)
                ->select('DEFAULTDEPTID')
                ->first();
            $menuTree = $this->menu->getMenuStructure(['deptId' => $user->DEFAULTDEPTID]);
        } else {
            $menuTree = $this->menu->getMenuStructure(['dlevel' => 4.0]);
        }
        return response()->json($menuTree);
    }
}
