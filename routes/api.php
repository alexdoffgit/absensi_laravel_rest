<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// $routes = DB::table('menu_links as ml')
//     ->whereNotNull('ml.laravel_controller_class')
//     ->whereNotNull('ml.laravel_controller_method')
//     ->whereNotNull('ml.http_method')
//     ->where('ml.route_type', '=', 'api')
//     ->select([
//         'ml.id',
//         'ml.menu_path',
//         'ml.laravel_controller_class',
//         'ml.laravel_controller_method',
//         'ml.laravel_middleware',
//         'ml.http_method'
//     ])
//     ->get();

// foreach ($routes as $value) {
//     if (!empty($value->laravel_middleware)) {
//         Route::match(
//             $value->http_method, 
//             $value->menu_path, 
//             [$value->laravel_controller_class, $value->laravel_controller_method]
//         )
//         ->middleware($value->laravel_middleware);
//     } else {
//         Route::match(
//             $value->http_method, 
//             $value->menu_path, 
//             [$value->laravel_controller_class, $value->laravel_controller_method]
//         );
//     }
// }