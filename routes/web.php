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
  SupplierController as Supplier,
};
use App\Http\Controllers\Sales\ {
  MemberController as Member,
  SpendingController as Spending
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

  //Routes For Category
  Route::resource('category', Category::class)->except(['show']);
  //End Routes Category
  
  //Routes For Product
  Route::resource('product', Product::class)->except(['edit']);
  Route::get('products/reports', [Product::class, 'reports'])->name('product.reports');
  Route::get('products/print-pdf', [Product::class, 'printPDF'])->name('product.print_pdf');
  Route::post('product/delete-selected',[Product::class, 'deleteSelected'])->name('product.delete_selected');
  //End Routes Product
  
  //Routes For Supplier
  Route::resource('supplier', Supplier::class)->except('show');
  //End Routes Supplier
  
  //Routes For Member
  Route::resource('member', Member::class)->except('show');
  //End Routes Member
  
  //Routes For Spending
  Route::resource('spending', Spending::class)->except('show');
  //End Routes Spending
});