<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BrandsController;
use App\Models\Category;
use App\Models\Products;
use App\Models\MainBanner;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\MainBannerController;
use App\Http\Controllers\WeblogPostsContorller;
use App\Models\User;

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
    return view('index');
});

Route::get('/admin-panel', function () {
    return view('admin.admin-dashboard');
})->name("admin-panel");

Route::get('/admin-banners',[MainBannerController::class , "index"])->name("admin-banner");
Route::get('/admin-banners/create',[MainBannerController::class , "create"])->name("admin-banner-create");
Route::post('/admin-banners/store',[MainBannerController::class , "store"])->name("admin-banner-store");
Route::get('/admin-banners/edit/{banner}',[MainBannerController::class , "edit"])->name("admin-banner-edit");
Route::get('/admin-banners/delete/{banner}',[MainBannerController::class , "destroy"])->name("admin-banner-delete");
Route::post('/admin-banners/update/{banner}',[MainBannerController::class , "update"])->name("admin-banner-update");


Route::get('/admin-category',[CategoryController::class , "index"])->name("admin-category");
Route::get('/admin-category/create',[CategoryController::class , "create"])->name("admin-category-create");
Route::post('/admin-category/store',[CategoryController::class , "store"])->name("admin-category-store");
Route::get('/admin-category/edit/{category}',[CategoryController::class , "edit"])->name("admin-category-edit");
Route::get('/admin-category/delete/{category}',[CategoryController::class , "destroy"])->name("admin-category-delete");
Route::post('/admin-category/update/{category}',[CategoryController::class , "update"])->name("admin-category-update");



Route::get('/admin-product',[ProductsController::class , "index"])->name("admin-product");
Route::get('/admin-product/create',[ProductsController::class , "create"])->name("admin-product-create");
Route::post('/admin-product/store',[ProductsController::class , "store"])->name("admin-product-store");
Route::get('/admin-product/edit/{product}',[ProductsController::class , "edit"])->name("admin-product-edit");
Route::get('/admin-product/delete/{product}',[ProductsController::class , "destroy"])->name("admin-product-delete");
Route::post('/admin-product/update/{product}',[ProductsController::class , "update"])->name("admin-product-update");



Route::get('/admin-brand',[BrandsController::class , "index"])->name("admin-brand");
Route::get('/admin-brand/create',[BrandsController::class , "create"])->name("admin-brand-create");
Route::post('/admin-brand/store',[BrandsController::class , "store"])->name("admin-brand-store");
Route::get('/admin-brand/edit/{brand}',[BrandsController::class , "edit"])->name("admin-brand-edit");
Route::get('/admin-brand/delete/{brand}',[BrandsController::class , "destroy"])->name("admin-brand-delete");
Route::post('/admin-brand/update/{brand}',[BrandsController::class , "update"])->name("admin-brand-update");



Route::get('/admin-about',[AboutUsController::class , "index"])->name("admin-about");
Route::get('/admin-about/create',[AboutUsController::class , "create"])->name("admin-about-create");
Route::post('/admin-about/store',[AboutUsController::class , "store"])->name("admin-about-store");
Route::get('/admin-about/edit/{about}',[AboutUsController::class , "edit"])->name("admin-about-edit");
Route::get('/admin-about/delete/{about}',[AboutUsController::class , "destroy"])->name("admin-about-delete");
Route::post('/admin-about/update/{about}',[AboutUsController::class , "update"])->name("admin-about-update");


Route::get("/weblog" , [WeblogPostsContorller::class , "index"])->name("weblog")->middleware("auth");
Route::get("/weblog/create/" , [WeblogPostsContorller::class , "create"])->name("weblog-create");
Route::post("/weblog/store/" , [WeblogPostsContorller::class , "store"])->name("weblog-store");
Route::get("/weblog/post/{post}" , [WeblogPostsContorller::class , "show"])->name("weblog-show");
Route::get("/weblog/edit/{post}" , [WeblogPostsContorller::class , "edit"])->name("weblog-edit");
Route::post("/weblog/update/{post}" , [WeblogPostsContorller::class , "update"])->name("weblog-update");
Route::get("/weblog/delete/{post}" , [WeblogPostsContorller::class , "destroy"])->name("weblog-delete");