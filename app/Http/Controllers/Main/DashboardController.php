<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\{DB, Auth};

// use App\Models\{ Order, Product, ProductCategory };


class DashboardController extends Controller
{

  public function __construct()
  {
    // if(Auth::check() || auth()->user()->role_id !== 1) {
    //   return redirect()->back()->with('error', 'Halaman tidak ditemukan !');
    // }  
  }

  
  public function index()
  {

    if( auth()->user()->role_id !== 1) {
      return redirect()->back()->with('error', 'Halaman tidak ditemukan !');
    }

    $stock = Products::all()->sum('stok');
    $totalBeli = DB::table('products')->sum(DB::raw('price_buy*stok'));
    
    return view('main.dashboard', compact('stock', 'totalBeli'));
  }

}