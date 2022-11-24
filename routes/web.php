<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\admin\PostController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\AdminListController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\User\CartController;

Route::redirect('/', 'user/home');
Route::get('/loginPage', [AuthController::class, 'loginPage'])->name('loginPage');
Route::get('/registerPage', [AuthController::class, 'registerPage'])->name('registerPage');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [AuthController::class, 'homePage'])->name('homePage');

    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {
        //category
        Route::prefix('category')->group(function () {
            Route::get('/page', [CategoryController::class, 'categoryPage'])->name('admin#categoryPage');
            Route::post('/create', [CategoryController::class, 'categoryCreate'])->name('admin#categoryCreate');
            Route::get('/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('admin#categoryDelete');
            Route::get('/edit/{id}', [CategoryController::class, 'categoryEdit'])->name('admin#categoryEdit');
            Route::post('/update', [CategoryController::class, 'categoryUpdate'])->name('admin#categoryUpdate');
        });

        //post
        Route::prefix('post')->group(function () {
            Route::get('/page', [PostController::class, 'postPage'])->name('admin#postPage');
            Route::post('/create', [PostController::class, 'postCreate'])->name('admin#postCreate');
            Route::get('/delete/{id}', [PostController::class, 'postDelete'])->name('admin#postDelete');
            Route::get('/edit/{id}', [PostController::class, 'postEdit'])->name('admin#postEdit');
            Route::post('/page', [PostController::class, 'postUpdate'])->name('admin#postUpdate');
        });

        //admin list
        Route::get('/list', [AdminListController::class, 'adminListPage'])->name('admin#listPage');
        Route::get('/delete/{id}', [AdminListController::class, 'listDelete'])->name('admin#listDelete');
        Route::get('/edit/{id}', [AdminListController::class, 'editPage'])->name('admin#editPage');
        Route::post('/update/account', [AdminListController::class, 'updateAdminAccount'])->name('admin#updateAdminAccount');
        Route::get('/change/passwordPage', [AdminListController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
        Route::post('/change/password', [AdminListController::class, 'changePassword'])->name('admin#changePassword');

        //user list
        Route::get('/userList', [AdminListController::class, 'userListPage'])->name('admin#userList');

        //order
        Route::get('/order', [OrderController::class, 'orderPage'])->name('admin#orderPage');
        Route::get('/order/state', [OrderController::class, 'orderState'])->name('admin#orderState');
    });

    Route::prefix('ajax')->group(function () {
        Route::get('/change/admin', [AjaxController::class, 'changeAdminRole']);
    });
});

//user
Route::group(['prefix' => 'user'], function () {
    Route::get('/home', [UserController::class, 'homePage'])->name('user#homePage');
    Route::get('/post/details/{id}', [UserController::class, 'postDetails'])->name('user#postDetails');
    Route::get('/category/filter/{id}', [UserController::class, 'filterCategory'])->name('user#filter');

    Route::group(['middleware' => ['user_auth', 'auth']], function () {
        Route::get('/cart/list', [CartController::class, 'cartList'])->name('user#cartList');
        Route::get('/cart/order', [CartController::class, 'cartOrder'])->name('user#cartOrder');
        Route::get('/cart/order/delete', [CartController::class, 'cartOrderDelete'])->name('user#cartOrderDelete');
        Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('user#clearCart');
        Route::get('/order', [CartController::class, 'order'])->name('user#order');

        Route::get('/order/history', [UserController::class, 'history'])->name('user#history');
        Route::get('/logout', [UserController::class, 'userLogout'])->name('user#logout');
    });
});
