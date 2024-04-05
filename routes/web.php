<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('auth.login');  // La raiz sera el LOGIN
})->name('login');

Auth::routes();

//Redirecciones
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/admin', [AdminController::class, 'index'])->name('adminhome');
    Route::get('/home/employee', [EmpleadoController::class, 'index'])->name('employeehome');
    Route::get('/home/admin/myprofile', function () { return view('admin.profile'); })->name('profile')->middleware('auth', 'admin');
    Route::get('/home/employee/myprofile', function () { return view('admin.profile'); })->name('profileempleado')->middleware('auth', 'employee');

//Rutas administrador

//Rutas administrador - Sesion peticiones
    Route::get('/home/admin/peticiones', [AdminController::class, 'showRequest'])->name('showRequest');
    Route::get('/home/admin/peticiones/{id}', [AdminController::class, 'seeSpecificRequest'])->name('seeSpecificRequest');
    Route::get('/home/admin/peticiones/{id}/save', [AdminController::class, 'acceptSpecificRequest'])->name('acceptSpecificRequest');
    Route::get('/home/admin/peticiones/{id}/delete', [AdminController::class, 'denySpecificRequest'])->name('denySpecificRequest');
    Route::get('/home/admin/changepassword', [AdminController::class, 'changePassword'])->name('changePassword');
    Route::post('/home/admin/savechange', [AdminController::class, 'saveChangePassword'])->name('saveChange');

//Rutas administrador - Sesion empleados
    Route::get('/home/admin/empleados', [AdminController::class, 'showEmployees'])->name('showEmployees');
    Route::get('/home/admin/empleados/create', [AdminController::class, 'createEmployee'])->name('createEmployee');
    Route::post('/home/admin/empleados/created',[AdminController::class, 'saveEmployee'])->name('saveEmployee');
    Route::get('/home/admin/empleados/edit/{id}', [AdminController::class, 'editEmployee'])->name('editEmployee');
    Route::post('/home/admin/empleados/update/{id}', [AdminController::class, 'updateEmployee'])->name('updateEmployee');
    Route::get('/home/admin/empleados/delete/{id}', [AdminController::class, 'deleteEmployee'])->name('deleteEmployee');

//Rutas administrador - Sesion historial
    Route::get('/home/admin/historial', [AdminController::class, 'showRequestHistory'])->name('showRequestHistory');


//Rutas empleado
    Route::get('/home/employee/crear', [EmpleadoController::class, 'createRequest'])->name('createRequest');
    Route::post('/home/employee/saveRequest', [EmpleadoController::class, 'saveRequest'])->name('saveRequest');
    Route::get('/home/employee/changepassword', [EmpleadoController::class, 'changePassword'])->name('changePasswordUser');
    Route::get('/home/employee/myrequests', [EmpleadoController::class, 'myRequests'])->name('myRequests');
    Route::get('/home/employee/myrequest/{id}', [EmpleadoController::class, 'seeMyRequest'])->name('seeMyRequest');
    Route::post('/home/employee/savenewpassword', [EmpleadoController::class, 'saveNewPassword'])->name('saveNewPasswordUser');


