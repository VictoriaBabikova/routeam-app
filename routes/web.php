<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectSearchController;

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
    return view('homePage');
});
Route::post('/project/search', [ProjectSearchController::class, 'SearchProgect'])->name('project_search');

Route::get('/projects/show', [ProjectSearchController::class, 'ShowProjectsList'])->name('projects_show');