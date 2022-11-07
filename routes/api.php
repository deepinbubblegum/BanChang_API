<?php

use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('get_data/{type}/{sensor}/{option?}', [DataController::class, 'get_data']);
    Route::get('get_status/{sensor}', [DataController::class, 'get_status']);
    Route::get('status/all', [DataController::class, 'device_all']);

    Route::post('logger', [LogController::class, 'save_log']);
    Route::post('setting/update', [SettingController::class, 'update']);
    Route::get('setting/list', [SettingController::class, 'getlist']);

    Route::group(['prefix' => 'users'], function () {
        Route::post('alluser', [UserController::class, 'all_user']);
        Route::get('profile/{id}', [UserController::class, 'user_profile']);
        Route::patch('profile/update/{id}', [UserController::class, 'user_update']);
        Route::delete('profile/destroy/{id}', [UserController::class, 'user_destroy']);
        Route::get('user', [UserController::class, 'user_by_id']);
    });
    Route::group(['prefix' => 'roles'], function () {
        Route::get('role', [RoleController::class, 'role_user']);
        Route::post('allrole', [RoleController::class, 'all_role']);
        Route::post('store', [RoleController::class, 'store']);
        Route::get('{id}', [RoleController::class, 'role_by_id']);
        Route::patch('update/{id}', [RoleController::class, 'update']);
        Route::post('destroy', [RoleController::class, 'destroy']);
    });

    Route::group(['prefix' => 'dashboard'], function () {
        Route::post('store', [DashboardController::class, 'store']);
        Route::post('list', [DashboardController::class, 'list_template']);
        Route::get('template/{id}', [DashboardController::class, 'template_by_id']);
        Route::patch('update/{id}', [DashboardController::class, 'update']);
        Route::post('destroy', [DashboardController::class, 'destroy']);
        Route::get('group_user_temp', [DashboardController::class, 'group_user_temp']);
        Route::get('user_temp', [DashboardController::class, 'user_temp']);
        Route::post('update_group', [DashboardController::class, 'update_group']);
        Route::post('update_user', [DashboardController::class, 'update_user']);
    });

    Route::group(['prefix' => 'widget'], function () {
        Route::post('list', [WidgetController::class, 'list_widget']);
        Route::get('listall', [WidgetController::class, 'list_widget_all']);
        Route::post('addcate', [WidgetController::class, 'addcate']);
        Route::post('updatecate', [WidgetController::class, 'updatecate']);
        Route::post('destroy', [WidgetController::class, 'destroy']);
    });

    Route::group(['prefix' => 'device'], function () {
        Route::post('store', [DeviceController::class, 'store']);
        Route::post('list', [DeviceController::class, 'list_device']);
        Route::get('list/ma', [DeviceController::class, 'device_ma']);
        Route::get('all', [DeviceController::class, 'list_device_all']);
        Route::get('{id}', [DeviceController::class, 'device_by_id']);
        Route::patch('update/{id}', [DeviceController::class, 'update']);
        Route::delete('destroy/{id}', [DeviceController::class, 'destroy']);
        Route::get('list/{cate}', [DeviceController::class, 'list_by_cate']);
        Route::post('map_data', [DeviceController::class, 'map_data']);
        Route::get('map_data/{id}', [DeviceController::class, 'map_data_device']);
        Route::post('filter', [DeviceController::class, 'filter_data']);

    });

    Route::group(['prefix' => 'complaint'], function () {
        Route::get('{id}', [ComplaintController::class, 'complaint_by_id']);
        Route::post('store', [ComplaintController::class, 'store']);
        Route::post('list', [ComplaintController::class, 'list_complanit']);
        Route::delete('destroy/{id}', [ComplaintController::class, 'destroy']);

    });
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::get('setting/data', [SettingController::class, 'get_sensor']);
Route::post('forgotpass', [UserController::class, 'forgot']);
Route::post('changepass', [UserController::class, 'changepass']);
