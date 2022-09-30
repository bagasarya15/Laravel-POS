<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ {
  AuthController,
  UserController as User
};
Use App\Http\Controllers\Main\ {
  DashboardController as Dashboard
};
use App\Http\Controllers\Product\ {
  CategoryController as Category,
  ProductController as Product,
};
use App\Http\Controllers\Sales\ {
  MemberController as Member,
  TransactionController as Transaction,
  TransactionDetailController as TransactionDetail
};



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

// Route::get('/', function () {
//     return view('auth.login', [
//     ]);   
// });

Route::get('/', [AuthController::class, 'redirectTo'])->name('home');

Route::middleware('guest')->controller(AuthController::class)->group(function() {
  
  Route::get('login', 'index')->name('login');
  Route::post('login', 'login')->name('login.post');
});

Route::middleware('auth')->group(function() {

  Route::resource('auth', AuthController::class)->except(['create', 'store', 'edit', 'show', 'destroy']);
  Route::get('logout', [AuthController::class, 'logout'])->name('logout');
  Route::resource('user', User::class)->except(['create', 'store','edit', 'show', 'destroy']);

  Route::get('dashboard', [Dashboard::class, 'index'])->name('dashboard');

  Route::resource('category', Category::class)->except(['show']);
  Route::resource('product', Product::class)->except(['edit']);

  Route::resource('member', Member::class)->except('show');
  Route::get('transaction/new', [Transaction::class, 'create'])->name('transaction.new');  
  Route::resource('transaction', TransactionDetail::class)->except(['show']);
});