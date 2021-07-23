<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
// * some route for "template"
Route::get('create-template', [TemplateController::class, 'create'])->name('create-new-template');
Route::get('create-from-template', [TemplateController::class, 'index'])
    ->name('create-from-template');
Route::get('/create-from-template/{id}', [TemplateController::class, 'createFromTemplate'] )
    ->name('use-template');
// * end route for "template"
