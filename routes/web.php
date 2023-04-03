<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    // Item
    Route::get('/items/index', [ItemController::class, 'index'])->name('items.index')->middleware('admin_auth');
    Route::group(['prefix' => 'items', 'middleware' => 'isAdmin'], function () {
        // for create item page
        Route::get('/create', [ItemController::class, 'createPage'])->name('items.createPage');
        // for create item
        Route::post('/create', [ItemController::class, 'create'])->name('items.create');
        // for edit item page
        Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('items.edit');
        // for update item
        Route::post('/edit/{id}', [ItemController::class, 'update'])->name('items.update');
        // for delete item
        Route::post('/delete/{id}', [ItemController::class, 'delete'])->name('items.delete');
        // for change publish status with ajax in index page
        Route::get('/change-status', [ItemController::class, 'changeStatus']);
    });

    // Category
    Route::group(['prefix' => 'categories', 'middleware' => 'isAdmin'], function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('categories.index');
        // for create category page
        Route::get('/create', [CategoryController::class, 'createPage'])->name('categories.createPage');
        // for create category
        Route::post('/create', [CategoryController::class, 'create'])->name('categories.create');
        // for edit category page
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
        // for update category
        Route::post('/edit/{id}', [CategoryController::class, 'update'])->name('categories.update');
        // for delete category
        Route::post('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        // for change status in index with ajax
        Route::get('/change-status', [CategoryController::class, 'changeStatus']);
    });

    // User
    Route::group(['prefix' => 'home', 'middleware' => 'isUser'], function () {
        Route::get('/index', [HomeController::class, 'index'])->name('home.index');
        // Search page by name and category
        Route::get('/search', [HomeController::class, 'search'])->name('home.search');
        // filter page when click category
        Route::get('/category/search/{id}', [HomeController::class, 'categorySearch'])->name('home.category');
        // for filter combinations
        Route::get('/category/filter', [HomeController::class, 'filterSearch'])->name('home.filter');
        // for clear filter
        Route::get('/clear-filter', function () {
            return redirect('/home/category/filter');
        })->name('home.clear');
        // for item details
        Route::get('/item/details/{id}', [HomeController::class, 'itemDetails'])->name('item.details');
    });
});
