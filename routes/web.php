<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    return Inertia\Inertia::render('Test');
});

Route::get('/home', function() {
    return Inertia\Inertia::render('Home/Index');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia\Inertia::render('Admin/Home');
})->name('admin');


//Admin
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog/new', [BlogController::class, 'addBlog'])->name('admin.blog.new');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog/{blog}/update', [BlogController::class, 'updateBlog'])->name('admin.blog.update');
Route::middleware(['auth:sanctum', 'verified'])->put('/admin/blog/{blog}/update', [BlogController::class, 'update'])->name('admin.blog.update.blog');
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/blog/add', [BlogController::class, 'store'])->name('admin.blog.add');
Route::middleware(['auth:sanctum', 'verified'])->delete('/admin/blog/{blog}/delete', [BlogController::class, 'destroy'])->name('admin.blog.delete');

//Blog Public Route
Route::get('/blog/{blog}', [BlogController::class, 'viewBlog'])->name('blog.view');


Route::middleware(['auth:sanctum', 'verified'])->get('/admin/projects', function () {
    return Inertia\Inertia::render('Admin/Views/Projects');
})->name('admin.projects');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
