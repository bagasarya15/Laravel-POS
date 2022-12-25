<?php

namespace App\Http\Controllers\Sales;

use App\Models\Order;
use App\Models\Settings;
use App\Models\Spending;
use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    public function index()
    {
        $store_information = Settings::find(1);
        return view('sales.finance.index', compact('store_information'));
    }

    public function print(Request $request)
    {        
        $firstDate  = $request->firstDate;
        $lastDate   = $request->lastDate;

        $store_information = Settings::findOrFail(1);
        $queryOrder = Order::with(['productOrder'])
            ->whereDate('created_at', '>=' ,$firstDate)
                ->whereDate('created_at', '<=', $lastDate)
                    ->get();

        $queryPurchase = PurchaseOrder::with(['getSupplier'])
            ->whereDate('created_at', '>=' ,$firstDate)
                ->whereDate('created_at', '<=', $lastDate)
                    ->get();

        $querySpending = Spending::where('created_at', '>=' ,$firstDate)
                ->whereDate('created_at', '<=', $lastDate)
                    ->get();

        $net_profit = $queryOrder->sum('total') - $queryPurchase->sum('payment') - $querySpending->sum('nominal'); 

        return view('sales.finance.print', compact([
            'store_information', 
            'firstDate', 
            'lastDate', 
            'queryOrder',
            'queryPurchase',
            'querySpending',
            'net_profit'
        ]));
    }
}
