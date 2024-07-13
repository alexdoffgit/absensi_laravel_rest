<?php

namespace App\Repository;

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
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id');

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
            'ms.menu_name',
            'ml.laravel_controller_class',
            'ml.laravel_controller_method',
            'ms.menu_level',
            'ms.parent'
        ])
            ->get();

        $emptyMenu = DB::table('menu_seq as ms')
            ->leftJoin('menu_links as ml', 'ms.menu_link_id', '=', 'ml.id')
            ->whereNull('ms.menu_link_id')
            ->select([
                'ms.id as seq_id',
                'ml.menu_path',
                'ms.menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ms.menu_level',
                'ms.parent'
            ])
            ->get();

        $genericMenu = DB::table('menu_links as ml')
            ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
            ->where('mlr.all_can_access', '=', 1)
            ->select([
                'ms.id as seq_id',
                'ml.menu_path',
                'ms.menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ms.menu_level',
                'ms.parent'
            ])
            ->get();

        $rootMenus = $emptyMenu->map(function ($item) {
            return $item->menu_name;
        })->toArray();

        $nestableGenericMenu = collect([]);
        $independentGenericMenu = collect([]);

        foreach ($genericMenu as $value) {
            $matched = false;
            foreach ($rootMenus as $prefix) {
                if (strpos($value->menu_name, $prefix) === 0) {
                    $nestableGenericMenu->push($value);
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $independentGenericMenu->push($value);
            }
        }
        unset($prefix);
        unset($value);

        $menus = $specificUserMenu->merge($emptyMenu)->merge($nestableGenericMenu);
        $menus = $menus->map(function ($item) {
            if (empty($item->parent)) {
                $item->children = [];
            }
            return $item;
        });
        $menus = $menus->pipe(function (Collection $collection) {
            $rootItems = $collection->filter(function ($item) {
                return property_exists($item, 'children');
            });

            foreach ($rootItems as $item1) {
                foreach ($collection as $item2) {
                    if ($item1->seq_id === $item2->parent) {
                        $splittedMenu = explode('.', $item2->menu_name);
                        $parentName = $splittedMenu[0];
                        $childName = $splittedMenu[1];
                        $item2->menu_name = $childName;
                        $item2->parent_name = $parentName;
                        $item1->children[] = $item2;
                    }
                }
            }

            return $rootItems;
        })
            ->merge($independentGenericMenu);

        return $menus->toArray();
    }
}
