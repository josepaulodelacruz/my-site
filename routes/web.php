<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProjectController;


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
//Admin projects
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects');
Route::middleware(['auth:sanctum', 'verified'])->get('/admin/projects/new', [ProjectController::class, 'addProjects'])->name('admin.projects.new');
Route::middleware(['auth:sanctum', 'verified'])->post('/admin/projects/add', [ProjectController::class, 'store'])->name('admin.projects.add');
Route::middleware(['auth:sanctum', 'verified'])->delete('/admin/projects/{project}/delete', [ProjectController::class, 'destroy'])->name('admin.projects.delete');

//Blog Public Route
Route::get('/blogs/{blog}', [BlogController::class, 'viewBlog'])->name('blog.view');
Route::get('/blogs', [BlogController::class, 'blogList'])->name('blogs');

//Tags route
Route::get('/admin/tags', [TagController::class, 'index'])->name('tags');
Route::post('/admin/tags', [TagController::class, 'store'])->name('tag.add');
Route::delete('/admin/tags/{tag}/delete', [TagController::class, 'destroy'])->name('tag.delete');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia\Inertia::render('Dashboard');
})->name('dashboard');
