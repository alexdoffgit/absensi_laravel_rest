<?php

namespace App\Repository;

use App\Interfaces\Menu as IMenu;
use Illuminate\Support\Facades\DB;

class Menu implements IMenu
{
    /**
     * @param array{
     *   userId?: int,
     *   deptId?: int,
     *   dlevel?: float
     * } $options
     * @return array
     */
    public function getMenuStructure($options)
    {
        $menuTable = DB::table('menu_links as ml')
            ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
            ->whereNotNull('ml.menu_name')
            ->whereNotNull('ml.laravel_controller_class')
            ->whereNotNull('ml.laravel_controller_method')
            ->select([
                'ml.menu_path',
                'ml.menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method'
            ])
            ->get()
            ->map(function ($item, $key) {
                $item->menu_name = explode('.', $item->menu_name);
                return $item;
            });

        // dd($menuTable->toArray());

        return $menuTable->toArray();
    }
}
