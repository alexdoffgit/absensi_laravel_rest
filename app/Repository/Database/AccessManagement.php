<?php

namespace App\Repository\Database;

use App\Interfaces\AccessManagement as IAccessManagement;
use Illuminate\Support\Facades\DB;


class AccessManagement implements IAccessManagement
{
    public function findAll()
    {
        $menuTable = DB::table('menu_links as ml')
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
            ->select(['ml.id', 'ml.menu_path', 'ms.menu_name'])
            ->get();

        $menu = $menuTable->map(function($item) {
            return (array) $item;
        });

        return $menu;
    }

    public function getOne($id)
    {
        $menuTable = DB::table('menu_links as ml')
            ->join('menu_links_roles as mlr', 'ml.id', '=', 'mlr.menu_link_id')
            ->join('menu_seq as ms', 'ml.id', '=', 'ms.menu_link_id')
            ->where('ml.id', '=', $id)
            ->select([
                'ml.id',
                'ml.menu_path',
                'ml.laravel_controller_class',
                'ml.laravel_controller_method',
                'ml.laravel_middleware',
                'ml.http_method',
                'ml.route_type',
                'mlr.user_id',
                'mlr.dept_id',
                'mlr.dlevel',
                'mlr.all_can_access',
                'ms.menu_name'
            ])
            ->first();

        return $menuTable->toArray();
    }

    /**
     * @param array{
     *   menu_path: string,
     *   menu_name?: string,
     *   laravel_controller_class: string,
     *   laravel_controller_method: string,
     *   laravel_middleware: string,
     *   http_method: string,
     *   route_type: string,
     *   user_id?: int,
     *   dept_id?: int,
     *   dlevel?: float,
     *   all_can_access?: boolean
     * } $data
     * @return void 
     */
    public function create($data)
    {
        DB::transaction(function() use ($data) {
            $menuLinkData = [];
            $removedKeys = [
                'user_id', 
                'dept_id', 
                'dlevel', 
                'all_can_access', 
                'menu_name'
            ];
            foreach ($data as $key => $value) {
                if (!in_array($key, $removedKeys)) {
                    $menuLinkData[$key] = $value;
                }
            }
            unset($key);
            unset($value);
            $menuLinkId = DB::table('menu_links')->insertGetId($menuLinkData);

            $menuLinksRoleData = [];
            $removedKeys = [
                'menu_path',
                'menu_name',
                'laravel_controller_class',
                'laravel_controller_method',
                'laravel_middleware',
                'http_method',
                'route_type',
            ];
            foreach ($data as $key => $value) {
                if (!in_array($key, $removedKeys)) {
                    $menuLinksRoleData[$key] = $value;
                }
            }
            unset($key);
            unset($value);
            $menuLinksRoleData['menu_link_id'] = $menuLinkId;
            DB::table('menu_links_roles')->insert($menuLinksRoleData);


            // TODO: make this code work for any menu level
            if (!empty($data['menu_name'])) {
                $menuSeqData = [
                    'menu_link_id' => $menuLinkId,
                    'menu_name' => $data['menu_name'],
                    'menu_level' => 1,
                ];
                DB::table('menu_seq')->insert($menuSeqData);
            }
        });
    }

    /**
     * @param array{
     *   menu_path?: string,
     *   menu_name?: string,
     *   laravel_controller_class?: string,
     *   laravel_controller_method?: string,
     *   laravel_middleware?: string,
     *   http_method?: string,
     *   route_type?: string,
     *   user_id?: int,
     *   dept_id?: int,
     *   dlevel?: float,
     *   all_can_access?: boolean
     * } $data,
     * @param int $id
     * @return void 
     */
    public function update($data, $id)
    {
        DB::transaction(function() use ($data, $id) {
            $menuLinkData = [];
            $removedKeys = [
                'user_id', 
                'dept_id', 
                'dlevel', 
                'all_can_access', 
                'menu_name'
            ];
            foreach ($data as $key => $value) {
                if (!in_array($key, $removedKeys)) {
                    $menuLinkData[$key] = $value;
                }
            }
            unset($key);
            unset($value);
            DB::table('menu_links')
                ->where('id', '=', $id)
                ->update($menuLinkData);

            $menuLinksRoleData = [];
            $removedKeys = [
                'menu_path',
                'menu_name',
                'laravel_controller_class',
                'laravel_controller_method',
                'laravel_middleware',
                'http_method',
                'route_type',
            ];
            foreach ($data as $key => $value) {
                if (!in_array($key, $removedKeys)) {
                    $menuLinksRoleData[$key] = $value;
                }
            }
            unset($key);
            unset($value);
            DB::table('menu_links_roles')
                ->where('menu_link_id', '=', $id)
                ->update($menuLinksRoleData);

            // TODO: make this code work for any menu level
            if (!empty($data['menu_name'])) {
                $menuSeqData = [
                    'menu_name' => $data['menu_name']
                ];
                DB::table('menu_seq')
                    ->where('menu_link_id', '=', $id)
                    ->update($menuSeqData);
            }
        });
    }

    public function delete($id)
    {
        DB::transaction(function() use ($id) {
            DB::table('menu_links')
                ->where('id', '=', $id)
                ->delete();

            DB::table('menu_links_roles')
                ->where('menu_link_id', '=', $id)
                ->delete();

            DB::table('menu_seq')
                ->where('menu_link_id', '=', $id)
                ->delete();
        });
    }
}
