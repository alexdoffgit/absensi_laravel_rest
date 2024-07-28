<?php

namespace App\Repository\Json;

use App\Interfaces\Menu as IMenu;
use Illuminate\Support\Facades\Storage;

class Menu implements IMenu {
    const IT_DEPARTMENT_ID_LANG = 159;
    const HR_DEPARTMENT_ID_LANG = 54;

    public function getMenuStructure($options)
    {
        $menu_department_IT_id_lang = [
            [
                'seq_id' => 1,
                'menu_path' => null,
                'menu_name' => 'Kehadiran',
                'children' => [
                    [
                        'seq_id' => 2,
                        'menu_path' => '/attendance/analysis',
                        'menu_name' => 'Pribadi'
                    ]
                ],
            ],
            [
                'seq_id' => 3,
                'menu_path' => null,
                'menu_name' => 'Cuti',
                'children' => [
                    [
                        'seq_id' => 4,
                        'menu_path' => '/leave-submission',
                        'menu_name' => 'Pengajuan'
                    ],
                    [
                        'seq_id' => 5,
                        'menu_path' => '/leave-tracking',
                        'menu_name' => 'Perkembangan'
                    ]
                ]
            ],
            [
                'seq_id' => 6,
                'menu_path' => null,
                'menu_name' => 'Jadwal',
                'children' => [
                    [
                        'seq_id' => 7,
                        'menu_path' => '/shift-schedule',
                        'menu_name' => 'Shift'
                    ]
                ]
            ],
            [
                'seq_id' => 8,
                'menu_path' => '/absence-accountability',
                'menu_name' => 'Pelanggaran Absensi',
            ],
            [
                'seq_id' => 9,
                'menu_path' => '/access-management',
                'menu_name' => 'Managemen Akses'
            ]
        ];

        $menu_department_HR_id_lang = [
            [
                'seq_id' => 1,
                'menu_name' => 'Kehadiran',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 2,
                        'menu_path' => '/hr/attendance/analysis',
                        'menu_name' => 'Karyawan' 
                    ],
                    [
                        'seq_id' => 3,
                        'menu_path' => '/attendance/analysis',
                        'menu_name' => 'Kehadiran'
                    ]
                ]
            ],
            [
                'seq_id' => 4,
                'menu_name' => 'Cuti',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 5,
                        'menu_name' => 'Daftar',
                        'menu_path' => '/hr/leave'
                    ],
                    [
                        'seq_id' => 6,
                        'menu_path' => '/leave-submission',
                        'menu_name' => 'Pengajuan'
                    ], 
                    [
                        'seq_id' => 7,
                        'menu_path' => '/leave-tracking',
                        'menu_name' => 'Perkembangan'
                    ],
                    [
                        'seq_id' => 8,
                        'menu_path' => '/hr/leave-approval',
                        'menu_name' => 'Persetujuan'
                    ]
                ]
            ],
            [
                'seq_id' => 9,
                'menu_name' => 'Jadwal',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 10,
                        'menu_name' => 'Shift',
                        'menu_path' => '/shift-schedule'
                    ],
                    [
                        'seq_id' => 11,
                        'menu_name' => 'Daftar',
                        'menu_path' => '/hr/schedule'
                    ]
                ]
            ],
            [
                'seq_id' => 12,
                'menu_name' => 'Pelanggaran Absen',
                'menu_path' => '/absence-accountability'
            ],
        ];

        $default_id_lang = [
            [
                'seq_id' => 1,
                'menu_name' => 'Kehadiran',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 2,
                        'menu_name' => 'Pribadi',
                        'menu_path' => '/attendance/analysis'
                    ],
                ]
            ],
            [
                'seq_id' => 3,
                'menu_name' => 'Cuti',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 4,
                        'menu_name' => 'Pengajuan',
                        'menu_path' => '/leave-submission'
                    ],
                    [
                        'seq_id' => 5,
                        'menu_name' => 'Perkembangan',
                        'menu_path' => '/leave-tracking'
                    ],
                ]
            ],
            [
                'seq_id' => 6,
                'menu_name' => 'Jadwal',
                'menu_path' => null,
                'children' => [
                    [
                        'seq_id' => 7,
                        'menu_name' => 'Shift',
                        'menu_path' => '/shift-schedule'
                    ]
                ]
            ],
            [
                'seq_id' => 8,
                'menu_name' => 'Pelanggaran Absensi',
                'menu_path' => '/absence-accountability'
            ]
        ];

        if ($options['deptId'] == self::HR_DEPARTMENT_ID_LANG) {
            return $menu_department_HR_id_lang;
        }

        if ($options['deptId'] == self::IT_DEPARTMENT_ID_LANG) {
            return $menu_department_IT_id_lang;
        }

        return $default_id_lang;
    }

    public function webLinks()
    {
        // REGION
            // $links = array(
            //     array(
            //     'id' => 1,
            //     'menu_path' => '/hr/attendance/analysis',
            //     'laravel_controller_class' => 'App\Http\Controllers\HR\EmployeesAttendanceController',
            //     'laravel_controller_method' => 'index',
            //     'laravel_middleware' => 'App\Http\Middleware\HRMenuAccessMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 3,
            //     'menu_path' => '/hr/leave-approval',
            //     'laravel_controller_class' => 'App\Http\Controllers\HR\LeaveController',
            //     'laravel_controller_method' => 'permitSummaries',
            //     'laravel_middleware' => 'App\Http\Middleware\HRMenuAccessMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 4,
            //     'menu_path' => '/hr/{approvalid}/{status}',
            //     'laravel_controller_class' => 'App\Http\Controllers\HR\LeaveController',
            //     'laravel_controller_method' => 'acceptOrReject',
            //     'laravel_middleware' => 'App\Http\Middleware\HRMenuAccessMiddleware',
            //     'http_method' => 'post',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 26,
            //     'menu_path' => '/manager/attendance/analysis',
            //     'laravel_controller_class' => 'App\Http\Controllers\Manager\EmployeesAttendanceController',
            //     'laravel_controller_method' => 'index',
            //     'laravel_middleware' => 'App\Http\Middleware\ManagerAccessMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 36,
            //     'menu_path' => '/attendance/analysis',
            //     'laravel_controller_class' => 'App\Http\Controllers\AttendanceController',
            //     'laravel_controller_method' => 'index',
            //     'laravel_middleware' => 'App\Http\Middleware\LoggedInMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 37,
            //     'menu_path' => '/leave-submission',
            //     'laravel_controller_class' => 'App\Http\Controllers\LeaveSubmissionController',
            //     'laravel_controller_method' => 'createView',
            //     'laravel_middleware' => 'App\Http\Middleware\ManagerAccessMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 38,
            //     'menu_path' => '/leave-tracking',
            //     'laravel_controller_class' => 'App\Http\Controllers\LeaveTrackingController',
            //     'laravel_controller_method' => 'leaveSummaries',
            //     'laravel_middleware' => '',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 39,
            //     'menu_path' => '/leave-tracking/{leaveid}',
            //     'laravel_controller_class' => 'App\Http\Controllers\LeaveTrackingController',
            //     'laravel_controller_method' => 'leaveDetail',
            //     'laravel_middleware' => '',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 48,
            //     'menu_path' => '/access-management',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'index',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 49,
            //     'menu_path' => '/hr/leave-approval/{id}',
            //     'laravel_controller_class' => 'App\Http\Controllers\HR\LeaveController',
            //     'laravel_controller_method' => 'permitDetail',
            //     'laravel_middleware' => 'App\Http\Middleware\HRMenuAccessMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 50,
            //     'menu_path' => '/logout',
            //     'laravel_controller_class' => 'App\Http\Controllers\AuthController',
            //     'laravel_controller_method' => 'logout',
            //     'laravel_middleware' => '',
            //     'http_method' => 'post',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 51,
            //     'menu_path' => '/login',
            //     'laravel_controller_class' => 'App\Http\Controllers\AuthController',
            //     'laravel_controller_method' => 'login',
            //     'laravel_middleware' => '',
            //     'http_method' => 'post',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 52,
            //     'menu_path' => '/',
            //     'laravel_controller_class' => 'App\Http\Controllers\AuthController',
            //     'laravel_controller_method' => 'loginView',
            //     'laravel_middleware' => '',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 53,
            //     'menu_path' => '/register',
            //     'laravel_controller_class' => 'App\Http\Controllers\AuthController',
            //     'laravel_controller_method' => 'registerView',
            //     'laravel_middleware' => '',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 54,
            //     'menu_path' => '/register',
            //     'laravel_controller_class' => 'App\Http\Controllers\AuthController',
            //     'laravel_controller_method' => 'register',
            //     'laravel_middleware' => '',
            //     'http_method' => 'post',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 57,
            //     'menu_path' => '/access-management/new',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'createView',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 58,
            //     'menu_path' => '/access-management/new',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'create',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'post',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 61,
            //     'menu_path' => '/access-management/{id}',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'show',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 62,
            //     'menu_path' => '/access-management/{id}/update',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'edit',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'get',
            //     'route_type' => 'web'
            //     ),
            //     array(
            //     'id' => 63,
            //     'menu_path' => '/access-management/{id}',
            //     'laravel_controller_class' => 'App\Http\Controllers\AccessManagementController',
            //     'laravel_controller_method' => 'destroy',
            //     'laravel_middleware' => 'App\Http\Middleware\ITAdminMiddleware',
            //     'http_method' => 'delete',
            //     'route_type' => 'web'
            //     )
            // );
        // ENDREGION
        $file =  Storage::get('menu.json');
        if (!empty($file)) {
            $links = json_decode($file, true);
        } else {
            $links = [];
        }
        return array_map(function($item) { return (object) $item; }, $links);
    }
}