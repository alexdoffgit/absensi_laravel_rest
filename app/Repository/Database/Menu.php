<?php

namespace App\Repository\Database;

use App\Interfaces\Menu as IMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
        $specificUserMenu = DB::table('menu_links as ml')
            ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
            ->where('ml.route_type', '=', 'web');

        if (array_key_exists('userId', $options)) {
            $specificUserMenu = $specificUserMenu->where('mlr.user_id', '=', $options['userId']);
        }

        if (array_key_exists('deptId', $options)) {
            $specificUserMenu = $specificUserMenu->where('mlr.dept_id', '=', $options['deptId']);
        }

        if (array_key_exists('dlevel', $options)) {
            $specificUserMenu = $specificUserMenu->where('mlr.dlevel', '=', $options['dlevel']);
        }

        $specificUserMenu = $specificUserMenu->select([
            'ms.id as seq_id',
            'ml.menu_path',
            'ms.menu_name_lang_ID as menu_name',
            'ml.laravel_controller_class',
            'ml.laravel_controller_method',
            'ms.menu_level',
            'ms.parent'
        ]);

        $emptyMenu = DB::table('menu_seq as ms')
            ->leftJoin('menu_links as ml', 'ms.menu_link_id', '=', 'ml.id')
            ->whereNull('ms.menu_link_id')
            ->select([
                'ms.id as seq_id',
                'ml.menu_path',
                'ms.menu_name_lang_ID as menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ms.menu_level',
                'ms.parent'
            ])->union($specificUserMenu);

        $genericMenu = DB::table('menu_links as ml')
            ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
            ->where('mlr.all_can_access', '=', 1)
            ->where('ml.route_type', '=', 'web')
            ->select([
                'ms.id as seq_id',
                'ml.menu_path',
                'ms.menu_name_lang_ID as menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ms.menu_level',
                'ms.parent'
            ])
            ->union($emptyMenu);
        
        $combinedMenu = $genericMenu
                ->get();


        $potentialNestableMenu = $combinedMenu->reject(function($item) {
            return $item->parent == null && is_string($item->menu_path);
        })
        ->values()
        ->map(function($item) {
            return (array) $item;
        })
        ->map(function($item) {
            $item['menu_name'] = explode('.', $item['menu_name']);
            $item['menu_name'] = $item['menu_name'][count($item['menu_name']) - 1];
            return $item;
        })
        ->toArray();

        $independentMenuNoSettings = $combinedMenu->filter(function($item) {
            return $item->parent == null && is_string($item->menu_path);
        })
        ->reject(function($item) {
            return $item->menu_name === 'Pengaturan';
        })
        ->values()
        ->map(function($item) {
            return (array) $item;
        })
        ->toArray();

        $menuTreeIncomplete = $this->menuTree($potentialNestableMenu);
        $menus = array_merge($menuTreeIncomplete, $independentMenuNoSettings);

        return $menus;
    }

    private function menuTree(array $potentialNestableMenu, $parentId = null)
    {
        $tree = [];
        foreach ($potentialNestableMenu as $item) {
            if($item['parent'] == $parentId) {
                $children = $this->menuTree($potentialNestableMenu, $item['seq_id']);
                if(count($children) > 0) {
                    $item['children'] = $children;
                }
                array_push($tree, $item);
            }
        }
        return $tree;
    }
}
