<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/clear-welcome-session', function () {
    session()->forget('welcome_shown');
    return response()->json(['status' => 'success']);
});

// Ruta del dashboard con nombre
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard'); // <-- Aquí asignamos el nombre "dashboard"

use App\Http\Controllers\UsuarioController;

Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');

//para inventario 
use App\Http\Controllers\InventarioController;

// Ruta resource principal
Route::resource('inventario', InventarioController::class)->parameters([
    'inventario' => 'inventario'
]);
Route::resource('inventarios', InventarioController::class);

// Ruta adicional para actualizar estados
Route::post('inventario/actualizar-estados', [InventarioController::class, 'actualizarEstados'])
    ->name('inventario.actualizar-estados');

 //ruta de productos, categorias y plantillas 
 // routes/web.php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PlantillaController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('plantillas', PlantillaController::class);
Route::get('/', [ProductController::class, 'mostrarEnWeb']);
use App\Http\Controllers\ProductoWebController;

Route::get('/producto/{id}', [ProductoWebController::class, 'mostrar'])->name('producto.detalle');






   



