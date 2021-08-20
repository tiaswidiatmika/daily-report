<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PresenceController;
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

Route::get('/', [PostController::class, 'dashboard'])->name('dashboard');

// ** TEMPLATE
// * show list of templates
Route::get('template', [TemplateController::class, 'index'])
    ->name('available-templates');

// * show form to create template
Route::get('template/new', [TemplateController::class, 'create'])
    ->name('create-new-template');

// * use template to show post form
Route::get('template/{id}/post/new', [TemplateController::class, 'createFromTemplate'] )
->name('use-template');

// * persist newly created template
Route::post('template/new', [TemplateController::class, 'store'])
    ->name('store-newly-created-template');
// // * use template to show post form
// Route::get('template/{id}/post/new', [TemplateController::class, 'createFromTemplate'] )
// ->name('use-template');
// * store post from existing template
Route::post('template/{id}/post/new', [PostController::class, 'storeFromTemplate'])
->name('store-post-from-template');
// *delete template
Route::delete('template/{id}/delete', [TemplateController::class, 'destroy'])
    ->name('delete-template');

// * POSTS
// * show all
Route::get('post', [PostController::class, 'index'])
    ->name('show-all-posts');

// * view form to create post
Route::get('post/create', [PostController::class, 'create'])
    ->name('create-post');
// * stream pdf
Route::get('post/show-pdf/{id}', [PostController::class, 'showPdf'])
    ->name('show-pdf');
// * show single
Route::get('post/{id}', [PostController::class, 'show'])
    ->name('show-post');

// * REPORT
// * show all
Route::get('report', [ReportController::class, 'index']);
Route::get('report/today', [ReportController::class, 'today'])
    ->name('todays-report');
Route::get('report/compose', [ReportController::class, 'compose'])
    ->name('compose-report');

// * USER
Route::get('presence', [PresenceController::class, 'create'])
    ->name('create-presence');
Route::post('presence', [PresenceController::class, 'store']);
// *
// ! playground route

// Route::get('playground', [ReportController::class, 'index']);