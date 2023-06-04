<?php

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
    return view('welcome');
});

// add fallback
// WARNING: must be the last route
Route::fallback(function () {
    $env_gaia_path = env('GAIA_PATH');
    // laravel base path
    $laravel_path = base_path();
    $path_gaia = realpath("$laravel_path/$env_gaia_path");

    ob_start();
    include $path_gaia;
    $code = ob_get_clean();

    return $code;

});
