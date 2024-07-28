<?php

namespace App\Interfaces;

interface AccessManagement
{
    public function findAll();
    public function getOne($id);

    /**
     * @param array{
     *   menu_path: string,
     *   menu_name: string,
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
    public function create($data);

    /**
     * @param array{
     *   menu_path: string,
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
    public function update($data, $id);
    
    public function delete($id);
}
