<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function() {
    return Inertia\Inertia::render('Home/Index');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin', function () {
    return Inertia\Inertia::render('Admin/Home');
})->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/blog/new', [BlogController::class, 'addBlog'])->name('admin.blog.new');
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/blog/add', [BlogController::class, 'store'])->name('admin.blog.add');
Route::middleware(['auth:sanctum', 'verified'])->delete('/admin/blog/{blog}/delete', [BlogController::class, 'destroy'])->name('admin.blog.delete');



Route::middleware(['auth:sanctum', 'verified'])->get('/admin/projects', function () {
    return Inertia\Inertia::render('Admin/Views/Projects');
})->name('admin.projects');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
