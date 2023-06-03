<?php
namespace App\Http\Controllers;


use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

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




// addRooms


Route::get('/sanpham',[PageController::class,'getIndex']);


Route::get('/type/{id}',[PageController::class,'getLoaiSp']);

Route::get('/detail/{id}',[PageController::class,'getDetail']);







Route::get('/luan4',[PageController::class,'marter']);





Route::get('/products', [ProductController::class, 'index'])->name('products.index');







Route::get('/admin',[PageController::class,'getIndexAdmin']);


Route::get('/add', [PageController::class, 'getAdminAdd'])->name('add-product');														
Route::post('/add', [PageController::class, 'postAdminAdd'])->name('admin-add-form');										
Route::get('/edit/{id}', [PageController::class, 'getAdminEdit']);												
Route::post('/edit/{id}', [PageController::class, 'postAdminEdit']);													

Route::post('/delete/{id}', [PageController::class, 'postAdminDelete']);






Route::get('/tinhtich/{a}/{b}', function ($a,$b) {
    echo $a*$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhtong/{a}/{b}', function ($a,$b) {
    echo $a+$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhhieu/{a}/{b}', function ($a,$b) {
    echo $a-$b;exit;
    
})->whereNumber('a')->whereNumber('b');
Route::get('/tinhthuong/{a}/{b}', function ($a,$b) {
    echo $a/$b;exit;
    
})->whereNumber('a')->whereNumber('b');