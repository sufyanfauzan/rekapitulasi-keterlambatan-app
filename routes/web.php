<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LatesController;

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

Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');

Route::middleware(['isGuest'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
});

Route::get('/error-permission', function(){
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['isLogin'])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('admin.index');
    // })->name('index');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('admin.index');
        Route::prefix('data.user')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
        });

        Route::prefix('data.rayon')->name('rayon.')->group(function () {
            Route::get('/', [RayonsController::class, 'index'])->name('index');
            Route::get('/create', [RayonsController::class, 'create'])->name('create');
            Route::post('/store', [RayonsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RayonsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RayonsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RayonsController::class, 'destroy'])->name('delete');
        });

        Route::prefix('data.rombel')->name('rombel.')->group(function () {
            Route::get('/', [RombelsController::class, 'index'])->name('index');
            Route::get('/create', [RombelsController::class, 'create'])->name('create');
            Route::post('/store', [RombelsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RombelsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [RombelsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RombelsController::class, 'destroy'])->name('delete');
        });
        Route::prefix('data.siswa')->name('siswa.')->group(function () {
            Route::get('/', [StudentsController::class, 'index'])->name('index');
            Route::get('/create', [StudentsController::class, 'create'])->name('create');
            Route::post('/store', [StudentsController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StudentsController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [StudentsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [StudentsController::class, 'destroy'])->name('delete');
        });
        Route::prefix('data.terlambat')->name('terlambat.')->group(function () {
            Route::get('/', [LatesController::class, 'index'])->name('index');
            Route::get('/create', [LatesController::class, 'create'])->name('create');
            Route::post('/store', [LatesController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [LatesController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}', [LatesController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [latesController::class, 'destroy'])->name('delete');
            Route::get('/show/{student_id}', [LatesController::class, 'show'])->name('show');
            Route::post('/terlambatCetakPdf/{studentId}', [LatesController::class, 'cetakPdf'])->name('terlambatCetakPdf');
            Route::get('/export', [LatesController::class, 'export'])->name('export');
        });
    });
    Route::middleware(['isPembimbingSiswa'])->group(function () {
        Route::get('/dashboard/ps', [DashboardController::class, 'indexSiswa'])->name('ps.index');
        Route::prefix('data.siswa.Ps')->name('siswaPs.')->group(function () {
            Route::get('/', [StudentsController::class, 'indexSiswa'])->name('indexPs');
        });
        Route::prefix('data.terlambat.Ps')->name('terlambatPs.')->group(function () {
            Route::get('/', [LatesController::class, 'indexSiswa'])->name('indexPs');
            Route::get('/show/{student_id}', [LatesController::class, 'show'])->name('showPs');
            Route::post('/terlambatCetakPdf/{studentId}', [LatesController::class, 'cetakPdf'])->name('terlambatCetakPdf');
            Route::get('/export', [LatesController::class, 'export'])->name('export');
        });
    });
});
