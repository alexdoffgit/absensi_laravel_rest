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
            ->leftJoin('menu_groups as mg', 'ml.menu_group_id', '=', 'mg.id')
            ->whereNotNull('ml.menu_group_id')
            ->select([
                'ml.menu_path',
                'ml.menu_name',
                'mg.group_name',
            ])
            ->get();

        $menuTable = $menuTable->groupBy('group_name');

        return $menuTable->toArray();
    }
}
