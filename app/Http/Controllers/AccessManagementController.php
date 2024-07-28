<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\AccessManagement;
use Illuminate\Support\Facades\DB;
use App\Rules\AccessManagement\AllCanAccessRule;
use App\Rules\AccessManagement\DepartmentRule;
use App\Rules\AccessManagement\DLevelRule;
use App\Rules\AccessManagement\UserRule;

class AccessManagementController extends Controller
{
    public function __construct(private AccessManagement $access) {}

    public function index()
    {
        

        $menus = $this->access->findAll();
        
        return view('access-management.list', ['menus' => $menus]);
    }

    public function createView()
    {
        $users = DB::table('userinfo')
            ->select(['USERID', 'fullname'])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->USERID,
                    'fullname' => $item->fullname
                ];
            })
            ->toArray();
        
        $departments = DB::table('departments')
            ->select(['DEPTID', 'DEPTNAME'])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->DEPTID,
                    'name' => $item->DEPTNAME
                ];
            })
            ->toArray();

        return view('access-management.create', [
            'users' => $users,
            'departments' => $departments
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'menu-path' => 'required',
            'menu-name' => 'nullable',
            'laravel-controller-class' => 'required',
            'laravel-controller-method' => 'required',
            'laravel-middleware' => 'required',
            'http-method' => 'required',
            'route-type' => 'required',
            'all-can-access' => [new AllCanAccessRule],
            'dlevel' => [new DLevelRule],
            'department' => [new DepartmentRule],
            'user' => [new UserRule]
        ]);

        $data = [
            'menu_path' => $validated['menu-path'],
            'menu_name' => $validated['menu-name'],
            'laravel_controller_class' => $validated['laravel-controller-class'],
            'laravel_controller_method' => $validated['laravel-controller-method'],
            'laravel_middleware' => $validated['laravel-middleware'],
            'http_method' => $validated['http-method'],
            'route_type' => $validated['route-type'],
            'user_id' => $validated['user'] != 0 ? intval($validated['user']) : null,
            'dept_id' => $validated['department'] != 0 ? intval($validated['department']) : null,
            'dlevel' => $validated['dlevel'] != 0 ? floatval($validated['dlevel']) : null,
            'all_can_access' => array_key_exists('all-can-access', $validated) ? true : false
        ];

        $this->access->create($data);

        return redirect('/access-management');
    }

    public function show(Request $request, $id)
    {
        $menu = $this->access->getOne($id);
        return view('access-management.show', ['menuId' => $id, 'menu' => $menu]);
    }

    public function edit(Request $request, $id)
    {
        $users = DB::table('userinfo')
            ->select(['USERID', 'fullname'])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->USERID,
                    'fullname' => $item->fullname
                ];
            })
            ->toArray();
        
        $departments = DB::table('departments')
            ->select(['DEPTID', 'DEPTNAME'])
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->DEPTID,
                    'name' => $item->DEPTNAME
                ];
            })
            ->toArray();

        $accessManagementFormData = $this->access->getOne($id);
        return view('access-management.edit', [
            'formData' => $accessManagementFormData, 
            'users' => $users, 
            'departments' => $departments
        ]);
    }

    public function destroy($id)
    {
        $this->access->delete($id);
        return redirect('/access-management');
    }
}
