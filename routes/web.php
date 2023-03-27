<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\productController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subcategoryController;
use App\Models\user;
use App\Models\category;
use App\Models\products;
use App\Models\subcategory;

Route::get('/', function () {
    return view('welcome');
});

Route::get('register', function () {
    return view('register');
});
Route::get('login', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('products', function () {
    $subcategory = subcategory::all();
    $subcategories = subcategory::all();
    $productos = products::all();
    return view('products', compact('subcategory', 'productos', 'subcategories'));
})->middleware('auth');

Route::get('categorys', function () {
    $category = category::all();
    return view('categorys', compact('category'));
})->middleware('auth');

Route::get('subcategorys', function () {
    $subcategory = subcategory::all();
    $categorys = category::all();
    $categories = category::all();
    return view('subcategorys', compact('subcategory', 'categorys', 'categories'));
})->middleware('auth');

Route::get('usuarios', function () {
    $users = User::all();
    return view('users', compact('users'));
})->middleware('auth');

Route::post('/logins', [userController::class, 'show']);
Route::post('/logout', [userController::class, 'logout']);
Route::post('/registers', [userController::class, 'create']);

Route::delete('/delete/{id}', [userController::class, 'delete'])->name('destroy');
Route::get('/editar/{id}', [userController::class, 'editar'])->name('editar');
Route::post('/actualizar', [userController::class, 'actualizar'])->name('actualizar');
Route::post('/createUser', [userController::class, 'registrar'])->name('createUser');

Route::post('/categoryeditar', [categoryController::class, 'editar'])->name('editcatg');
Route::post('/guardarCategory', [categoryController::class, 'guardar'])->name('guardarcatg');
Route::delete('/editarcategory/{id}', [categoryController::class, 'eliminar'])->name('destroy_categ');

Route::post('/subcategoryeditar', [subcategoryController::class, 'editar'])->name('editsubcatg');
Route::post('/guardarsubCategory', [subcategoryController::class, 'guardar'])->name('guardarsubcatg');
Route::delete('/subcategoryeditar/{id}', [subcategoryController::class, 'eliminar'])->name('destroy_subc');

Route::post('/producteditar', [productController::class, 'editar'])->name('editproduc');
Route::post('/guardarproduct', [productController::class, 'guardar'])->name('guardarproduc');
Route::delete('/producteditar/{id}', [productController::class, 'eliminar'])->name('destroy_produc');
