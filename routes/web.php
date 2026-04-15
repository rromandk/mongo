<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InstitucionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OllamaController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'admin'])
    ->name('admin.') // 👈 ESTO FALTABA para que funcionen las rutas /admin/sarasa
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::resource('users', UserController::class);
});

//esto dice: TODAS las rutas de posts requieren login
Route::middleware(['auth','log.requests'])->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('instituciones', InstitucionController::class);
    Route::get('/ollama', [OllamaController::class, 'index'])->name('ollama.index');
    Route::post('/ollama', [OllamaController::class, 'generate'])->name('ollama.generate');
});



Route::get('/documents/{id}/download', [DocumentController::class, 'download'])
    ->middleware('auth')
    ->name('documents.download');

/*  este era de Breeze que lo quite para usar el de filament.  

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */

// ========== SISTEMA LEGACY - ELIMINADO ==========
// Ya no usamos /legacy-admin, ahora usamos Filament en /admin

// ========== RUTA DASHBOARD REDIRIGIDA A FILAMENT ==========
// Cualquier intento de acceso a /dashboard va a Filament
Route::redirect('/dashboard', '/admin')->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
