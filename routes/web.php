<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/login', [Authentication::class, 'index'])->name('login');

Route::post('/login', [Authentication::class, 'check_login'])->name('login.check');


Route::get('/register', function () {
    return view('Auth.register');
})->name('register');

Route::post('/register', [Authentication::class, 'register'])->name('register.check');

Route::get('/dashboard', [Dashboard::class, 'homepage'])->name('dashboard');

Route::get('/logout', [Authentication::class, 'logout'])->name('logout');

Route::get('/link/create', [Dashboard::class, 'create_link'])->name('links.create');

Route::post('/link/store', [Dashboard::class, 'store_link'])->name('links.store');

Route::get('/profile/:id', [Dashboard::class, 'profile'])->name('profile.view');

Route::post('/link/delete/:id', [Dashboard::class, 'delete_link'])->name('links.delete');

Route::get('/link/{username}', [Dashboard::class, 'view_link'])->name('link.view');

Route::get('/view/count', [Dashboard::class, 'view_count'])->name('blog.view');

Route::get('link/view/count', [Dashboard::class, 'link_view_count'])->name('blog.view.count');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

Route::post('/admin/delete/', [AdminController::class, 'delete_user'])->name('admin.users.destroy');
