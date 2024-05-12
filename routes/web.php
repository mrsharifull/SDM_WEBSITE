<?php

use App\Http\Controllers\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Admin\AdminManagement\PermissionController;
use App\Http\Controllers\Admin\AdminManagement\RoleController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\Setup\BloodGroupController;
use App\Http\Controllers\Admin\Setup\BoardCointroller;
use App\Http\Controllers\Admin\Setup\ClassController;
use App\Http\Controllers\Admin\Setup\DepartmentController;
use App\Http\Controllers\Admin\Setup\SectionController;
use App\Http\Controllers\Admin\Setup\SessionController;
use App\Http\Controllers\Backend\UserManagement\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::post('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::post('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
// Custom User Backend Routes  //
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
Route::group(['middleware' => 'auth'], function () {
	Route::get('user/index', [UserController::class,'index'])->name('user.index');
	Route::get('user/create', [UserController::class,'create'])->name('user.create');
});


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
// Custom Admin Backend Routes //
//XXXXXXXXXXXXXXXXXXXXXXXXXXXXX//
Route::get('admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class,'loginCheck'])->name('admin.login');

Route::group(['middleware' => ['admin','permission']], function () {
	Route::get('admin/dashboard', [AdminDashboardController::class,'dashboard'])->name('admin.dashboard');
	Route::get('/export-permissions', function () {
        $filename = 'permissions.csv';
        $filePath = createCSV($filename);
        return Response::download($filePath, $filename);
    })->name('export.permissions');


	// Admin Management Routes
	Route::group(['as' => 'am.', 'prefix' => 'admin-management'], function () {

		Route::controller(AdminController::class)->prefix('admin')->name('admin.')->group(function () {
			Route::get('index', 'index')->name('admin_list');
			Route::get('details/{id}', 'details')->name('details.admin_list');
			Route::get('profile/{id}', 'profile')->name('admin_profile');
			Route::get('create', 'create')->name('admin_create');
			Route::post('create', 'store')->name('admin_create');
			Route::get('edit/{id}', 'edit')->name('admin_edit');
			Route::post('edit/{id}', 'update')->name('admin_edit');
			Route::get('status/{id}', 'status')->name('status.admin_edit');
			Route::get('delete/{id}', 'delete')->name('admin_delete');
		});
		Route::controller(PermissionController::class)->prefix('permission')->name('permission.')->group(function () {
			Route::get('index', 'index')->name('permission_list');
			Route::get('details/{id}', 'details')->name('details.permission_list');
			Route::get('create', 'create')->name('permission_create');
			Route::post('create', 'store')->name('permission_create');
			Route::get('edit/{id}', 'edit')->name('permission_edit');
			Route::post('edit/{id}', 'update')->name('permission_edit');
		});
		Route::controller(RoleController::class)->prefix('role')->name('role.')->group(function () {
			Route::get('index', 'index')->name('role_list');
			Route::get('details/{id}', 'details')->name('details.role_list');
			Route::get('create', 'create')->name('role_create');
			Route::post('create', 'store')->name('role_create');
			Route::get('edit/{id}', 'edit')->name('role_edit');
			Route::post('edit/{id}', 'update')->name('role_edit');
			Route::get('delete/{id}', 'delete')->name('role_delete');
		});
	});

	// Admin > Setup
	Route::group(['as' => 'setup.', 'prefix' => 'setup'], function () {

		Route::controller(ClassController::class)->prefix('class')->name('class.')->group(function () {
			Route::get('index', 'index')->name('class_list');
			Route::get('details/{id}', 'details')->name('details.class_list');
			Route::get('create', 'create')->name('class_create');
			Route::post('create', 'store')->name('class_create');
			Route::get('edit/{id}', 'edit')->name('class_edit');
			Route::post('edit/{id}', 'update')->name('class_edit');
			Route::get('status/{id}', 'status')->name('status.class_edit');
			Route::get('delete/{id}', 'delete')->name('class_delete');
		});
		Route::controller(SectionController::class)->prefix('section')->name('section.')->group(function () {
			Route::get('index', 'index')->name('section_list');
			Route::get('details/{id}', 'details')->name('details.section_list');
			Route::get('create', 'create')->name('section_create');
			Route::post('create', 'store')->name('section_create');
			Route::get('edit/{id}', 'edit')->name('section_edit');
			Route::post('edit/{id}', 'update')->name('section_edit');
			Route::get('status/{id}', 'status')->name('status.section_edit');
			Route::get('delete/{id}', 'delete')->name('section_delete');
		});
		Route::controller(BloodGroupController::class)->prefix('blood-group')->name('bg.')->group(function () {
			Route::get('index', 'index')->name('bg_list');
			Route::get('details/{id}', 'details')->name('details.bg_list');
			Route::get('create', 'create')->name('bg_create');
			Route::post('create', 'store')->name('bg_create');
			Route::get('edit/{id}', 'edit')->name('bg_edit');
			Route::post('edit/{id}', 'update')->name('bg_edit');
			Route::get('status/{id}', 'status')->name('status.bg_edit');
			Route::get('delete/{id}', 'delete')->name('bg_delete');
		});
		Route::controller(DepartmentController::class)->prefix('department')->name('department.')->group(function () {
			Route::get('index', 'index')->name('department_list');
			Route::get('details/{id}', 'details')->name('details.department_list');
			Route::get('create', 'create')->name('department_create');
			Route::post('create', 'store')->name('department_create');
			Route::get('edit/{id}', 'edit')->name('department_edit');
			Route::post('edit/{id}', 'update')->name('department_edit');
			Route::get('status/{id}', 'status')->name('status.department_edit');
			Route::get('delete/{id}', 'delete')->name('department_delete');
		});
		Route::controller(BoardCointroller::class)->prefix('board')->name('board.')->group(function () {
			Route::get('index', 'index')->name('board_list');
			Route::get('details/{id}', 'details')->name('details.board_list');
			Route::get('create', 'create')->name('board_create');
			Route::post('create', 'store')->name('board_create');
			Route::get('edit/{id}', 'edit')->name('board_edit');
			Route::post('edit/{id}', 'update')->name('board_edit');
			Route::get('status/{id}', 'status')->name('status.board_edit');
			Route::get('delete/{id}', 'delete')->name('board_delete');
		});
		Route::controller(SessionController::class)->prefix('session')->name('session.')->group(function () {
			Route::get('index', 'index')->name('session_list');
			Route::get('details/{id}', 'details')->name('details.session_list');
			Route::get('create', 'create')->name('session_create');
			Route::post('create', 'store')->name('session_create');
			Route::get('edit/{id}', 'edit')->name('session_edit');
			Route::post('edit/{id}', 'update')->name('session_edit');
			Route::get('status/{id}', 'status')->name('status.session_edit');
			Route::get('delete/{id}', 'delete')->name('session_delete');
		});
	});

});

