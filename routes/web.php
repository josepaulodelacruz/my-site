<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/home', function() {
    return Inertia\Inertia::render('Home/Index');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia\Inertia::render('Admin/Home');
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog', function () {
    return Inertia\Inertia::render('Admin/Views/Blog');
})->name('admin.blog');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog/add', function () {
    return Inertia\Inertia::render('Admin/Views/AddBlog');
})->name('admin.blog.add');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/projects', function () {
    return Inertia\Inertia::render('Admin/Views/Projects');
})->name('admin.projects');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
