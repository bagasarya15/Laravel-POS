<?php

namespace App\Http\Controllers\Main;

use App\Models\ {
  User, 
  Order, 
  Products, 
  Spending, 
  Settings, 
  OrderProduct,
  PurchaseOrder, 
  PurchaseProducts,
};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\{DB, Auth};
  

// use App\Models\{ Order, Product, ProductCategory };


class DashboardController extends Controller
{

  public function __construct(Gate $gate) 
  {
    $gate->define('dashboard', fn($user) => $user->role_id == 1 );
    
    $this->middleware('can:dashboard');
  }

  

  public function index()
  {
    $spending           = Spending::all();
    $store_information  = Settings::findOrFail(1);
    $order              = Order::with('member')->orderBy('id', 'desc')->get();
    $purchaseOrder      = PurchaseOrder::with('getSupplier')->orderBy('id', 'desc')->get();

    $orderByMonth = Order::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('total');

    $purchaseByMonth = PurchaseOrder::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('total');
        
    $spendingsByMonth = Spending::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('nominal');

    $profitByMonth = Order::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('total')     - 
        PurchaseOrder::whereMonth('created_at', Carbon::now()->month)
          ->whereYear('created_at', Carbon::now()->year)    
            ->sum('total') -
          Spending::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)    
              ->sum('nominal');
              
    $orderByDate = Order::whereDate('created_at', Carbon::now())->sum('total');

    $purchaseProduct = PurchaseProducts::whereDate('created_at', Carbon::now())->sum('qty');

    $soldProduct = OrderProduct::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('qty');

    $net_profit = $order->sum('total') - $spending->sum('nominal') - $purchaseOrder->sum('total'); 

    return view('main.dashboard', compact([
      'store_information',
      'order',
      'purchaseOrder',
      'orderByMonth',
      'purchaseByMonth',
      'spendingsByMonth',
      'profitByMonth',
      'orderByDate',
      'purchaseProduct',
      'soldProduct',
      'net_profit',
    ]));
  }
}