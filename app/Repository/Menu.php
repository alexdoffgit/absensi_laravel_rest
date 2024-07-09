<?php

namespace App\Repository;

use App\Interfaces\Menu as IMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use function PHPSTORM_META\map;

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
        $options = [
            'deptId' => 54
        ];

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
            'ml.menu_path',
            'ms.menu_name',
            'ml.laravel_controller_class',
            'ml.laravel_controller_method',
            'ms.menu_level'
        ])
        ->get();

        $emptyMenu = DB::table('menu_seq as ms')
            ->leftJoin('menu_links as ml', 'ms.menu_link_id', '=', 'ml.id')
            ->whereNull('ms.menu_link_id')
            ->select([
                'ml.menu_path',
                'ms.menu_name',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ms.menu_level'
            ])
            ->get();

        $genericMenu = DB::table('menu_links as ml')
                ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
                ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
                ->where('mlr.all_can_access', '=', 1)
                ->select([
                    'ml.menu_path',
                    'ms.menu_name',
                    'ml.laravel_controller_class',
                    'ml.laravel_controller_method',
                    'ms.menu_level'
                ])
                ->get();
        
        $rootMenus = $emptyMenu->map(function($item) {
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
            if(!$matched) {
                $independentGenericMenu->push($value);
            }
        }
        unset($prefix);
        unset($value);

        $menus = $specificUserMenu->merge($emptyMenu)->merge($nestableGenericMenu);

        $menus = $menus
            ->sort(function($a, $b) use ($rootMenus) {
                // Extract root menus name
                $rootMenusA = explode('.', $a->menu_name)[0];
                $rootMenusB = explode('.', $b->menu_name)[0];

                // Compare the root menu based on their order in $rootMenus
                $rootPositionA = array_search($rootMenusA, $rootMenus);
                $rootPositionB = array_search($rootMenusB, $rootMenus);

                if ($rootMenusA === $rootMenusB) {
                    return strcmp($a->menu_name, $b->menu_name);
                }

                return $rootPositionA <=> $rootPositionB;
            })
            ->values();

        $menus = $menus->merge($independentGenericMenu);
        $menus = $menus->map(function($item, $key) {
            if($item->menu_level == 2) {
                $item->menu_name = explode('.', $item->menu_name)[1];
            }
            return $item;
        });

        return $menus->toArray();
    }
}
