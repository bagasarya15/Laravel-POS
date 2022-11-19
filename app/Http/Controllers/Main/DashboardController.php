<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ {Products, Settings};
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\{DB, Auth};

// use App\Models\{ Order, Product, ProductCategory };


class DashboardController extends Controller
{

  public function __construct(Gate $gate) 
  {
    $gate->define('dashboard', fn($user) => $user->role_id == 1);
    
    $this->middleware('can:dashboard');
  }

  
  public function index()
  {
    //Variabel For Title Menu
    $getTitle = Settings::findOrFail(1);
    $stock = Products::all()->sum('stok');
    $totalBeli = DB::table('products')->sum(DB::raw('price_buy*stok'));
    
    return view('main.dashboard', compact('getTitle','stock', 'totalBeli'));
  }
}