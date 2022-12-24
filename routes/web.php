<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ {
  AuthController,
  UserController as User
};
Use App\Http\Controllers\Main\ {
  DashboardController as Dashboard,
  SystemInfoController as SystemInfo,
};
use App\Http\Controllers\Product\ {
  CategoryController as Category,
  ProductController as Product,
  SupplierController as Supplier,
};
use App\Http\Controllers\Sales\ {
  MemberController as Member,
  SpendingController as Spending,
  TransactionController as Transaction,
  PurchaseController as Purchase,
};
use App\Http\Controllers\Settings\ {
  SettingController as Settings,
  RoleAccessController as RoleAccess,
};
// ================================================================//

//Routes Config
Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Success, Routes cache cleared';
});

Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Success, Config cache cleared';
    
});

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return redirect()->back()->with('success', 'Application cache cleared');
});

Route::get('/view-cache', function() {
    Artisan::call('view:cache');
    return redirect()->back()->with('success', 'View cache cleared');
});

Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return redirect()->back()->with('success', 'Storage:link created');
});
//End Routes Config

// ================================================================//
Route::get('/', [AuthController::class, 'redirectTo'])->name('home');
// Route::get('/', 'redirectTo')->name('home');

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
  
  // Routes For Transaction
  Route::resource('transaction', Transaction::class)->except(['create','edit','update','destroy']);
  Route::get('data-transaction', [Transaction::class, 'dataTransaction'])->name('data-transaction');
  Route::post('add-member', [Transaction::class, 'addMember'])->name('transaction.add-member');
  Route::get('invoice/{no_order}', [Transaction::class, 'invoice'])->name('transaction.invoice');
  // End Routes Transaction

  // Routes For Purchase Product
  Route::resource('purchase', Purchase::class)->except(['create','edit','update','destroy']);
  Route::get('data-purchase', [Purchase::class, 'dataPurchase'])->name('data-purchase');
  Route::get('purchase-invoice/{no_purchase}', [Purchase::class, 'purchaseInvoice'])->name('purchase.invoice');
  // End Routes Purchase Product

  //Routes For Settings
  Route::resource('settings', Settings::class)->except(['create','store','edit','destroy']);
  Route::get('artisan-call', [Settings::class, 'artisan_call'])->name('artisan.index');
  //End Routes Settings

  //Routes For Access Role
  Route::resource('user-access', RoleAccess::class)->except(['create', 'edit']);
  Route::put('reset-password/{user_access}', [RoleAccess::class, 'resetPassword'])->name('user.reset-password');
  //End Routes Access Role

  //Routes For Access System Infomation
  Route::resource('system-info', SystemInfo::class)->except(['create','edit']);
  //End Routes Access System Infomation
});