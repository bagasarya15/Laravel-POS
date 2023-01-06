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

class DashboardController extends Controller
{

  public function __construct(Gate $gate) 
  {
    $gate->define('dashboard', fn($user) => $user->role_id == 1 || $user->role_id  == 2 );
    
    $this->middleware('can:dashboard');
  }

  

  public function index()
  {
    $firstDate          = Carbon::now()->format('M');
    $lastDate           = Carbon::now()->format('M');
    $store_information  = Settings::findOrFail(1);
    $order              = Order::with('member')->orderBy('id', 'desc')->get();
    $purchaseOrder      = PurchaseOrder::with('getSupplier')->orderBy('id', 'desc')->get();

    $totalOrder = Order::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('total');

    $totalPurchase = PurchaseOrder::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('total');

    $totalSpending = Spending::whereMonth('created_at', Carbon::now()->month)
      ->whereYear('created_at', Carbon::now()->year)    
        ->sum('nominal');

    $netProfit = $totalOrder - $totalPurchase - $totalSpending;
        
    return view('main.dashboard', compact([
      'firstDate',
      'lastDate',
      'store_information',
      'order',
      'purchaseOrder',
      'totalOrder',
      'totalPurchase',
      'totalSpending',
      'netProfit',
    ]));
  }

  public function searchByDate(Request $request)
  {
    $firstDate  = $request->firstDate;
    $lastDate   = $request->lastDate;
    
    if($firstDate == null) {
      return redirect()->route('dashboard')->with('info', 'Pilih rentang tanggal yang ingin difilter');
    }

    $store_information  = Settings::findOrFail(1);
    $order              = Order::with('member')->orderBy('id', 'desc')->get();
    $purchaseOrder      = PurchaseOrder::with('getSupplier')->orderBy('id', 'desc')->get();

    $totalOrder = Order::whereDate('created_at', '>=' ,$firstDate )
                ->whereDate('created_at', '<=', $lastDate)
                    ->sum('total');

    $totalPurchase = PurchaseOrder::whereDate('created_at', '>=' ,$firstDate )
                ->whereDate('created_at', '<=', $lastDate)
                    ->sum('total');

    $totalSpending = Spending::whereDate('created_at', '>=' ,$firstDate )
                ->whereDate('created_at', '<=', $lastDate)
                    ->sum('nominal');

    $netProfit = $totalOrder - $totalPurchase - $totalSpending;

    return view('main.dashboard', compact([
      'firstDate',
      'lastDate',
      'store_information',
      'order',
      'purchaseOrder',
      'totalOrder',
      'totalPurchase',
      'totalSpending',
      'netProfit'
    ]));
  }
}