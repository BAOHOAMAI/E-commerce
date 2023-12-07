<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Frontend\FE_BlogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\PageHomeController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\MailController;
use App\Http\Controllers\Frontend\ProductDetailController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\HomeController;
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


// USER 



Route::get('/', [PageHomeController::class, 'getItem'])->name('main');

Route::get('/productdetails/{id}', [ProductDetailController::class, 'getProductDetail'])->name('getProductDetail');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
Route::post('/remove-cart', [CartController::class, 'removeCart'])->name('removeCart');


Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('checkout');
Route::get('/test', [MailController::class, 'index'])->name('mail');

Route::get('/cart', function () {
    return view('frontend\cart\cart');
})->name ('cart');

Route::get('/product', function () {
    return view('frontend\product\product');
})->name ('product');

// CHƯA LOGIN 

Route::group([
    'prefix' => 'member',
], function () {

    Route::get('/login', [RegisterController::class, 'login'])->name('memberlogin');
    Route::post('/login', [RegisterController::class, 'getlogin'])->name ('postlogin');

    Route::get('logout', [RegisterController::class, 'logout'])->name('memberlogout');

    Route::get('/register', [RegisterController::class, 'index'])->name ('memberregister');
    Route::post('/register', [RegisterController::class, 'register'])->name ('postregister');

    Route::get('/blog',[FE_BlogController::class, 'index'])->name('getblog');

    Route::get('/blogsingle/{id}',[FE_BlogController::class, 'blogsingle'])->name('blogsingle');
    Route::post('/blogsingle/{id}',[FE_BlogController::class, 'rating'])->name('rating');
    Route::post('/blog/comment/{id}',[FE_BlogController::class, 'comment'])->name('comment');

});

Route::group([
    'prefix' => 'account',
], function () {
    Route::get('/', [ProfileController::class, 'index'])->name ('account');
    Route::post('/', [ProfileController::class, 'updateprofile'])->name ('account');

    Route::get('/myproduct', [ProductController::class, 'myproduct'])->name ('myproduct');

    Route::post('/add-product', [ProductController::class, 'postadd'])->name ('addproduct');
    Route::get('/add-product', [ProductController::class, 'addproduct'])->name ('addproduct');


    Route::get('/edit-product/{id}', [ProductController::class, 'getEdit'])->name ('editproduct');
    Route::post('/edit-product/{id}', [ProductController::class, 'postEditProduct'])->name('editproduct');

    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteproduct');

});






// ADMIN 




Auth::routes();

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::group([

    'prefix' => 'admin',

], function () {

    // DASHBOARD

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // COUNTRY

    Route::get('/country', [CountryController::class, 'getCountry'])->name('country');

    Route::get('/addcountry', [CountryController::class, 'getAddCountry'])->name('getAddCountry');
    Route::post('/addcountry', [CountryController::class, 'uploadCountry'])->name('uploadCountry');

    Route::get('/deletecountry/{id}',[CountryController::class,'deleteCountry'])->name('deletecountry');

    // PROFILE 

    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('updateProfile');


    // BLOG 

    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::get('/addblog', [BlogController::class, 'getAddBlog'])->name('getBlog');
    Route::post('/addblog', [BlogController::class, 'addBlog'])->name('addBlog');

    Route::post('/editblog/{id}', [BlogController::class, 'postEditBlog'])->name('postEditBlog');
    Route::get('/editblog/{id}', [BlogController::class, 'editBlog'])->name('editBlog');

    Route::get('/deleteblog/{id}',[BlogController::class, 'deleteBlog'])->name('deleteBlog');


});