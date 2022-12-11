<?php

namespace App\Http\Controllers\Sales;

use App\Models\Order;
use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use App\Models\{Products, Transaction, OrderProduct, Members, OrderMember};


class TransactionController extends Controller
{
    public function index()
    {
        $getTitle = Settings::find(1);
        return view('sales.transaction.index', compact('getTitle'));
    }

    public function store(Request $request)
    {   
        $rules = [
            'product_id' => 'required|unique:transactions'
        ];

        $eMessage = [
            'product_id.required' => 'Pilih produk terlebih dahulu !',
            'product_id.unique' => 'Produk sudah ada dikeranjang !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $transaction = new Transaction;
        $transaction->product_id = $request->product_id;
        $transaction->qty = $request->qty;
        $transaction->total = $request->total;
        $transaction->save();
        
        return redirect()->back()->with('success', 'Produk berhasil ditambah keranjang!');
    }

    public function addMember(Request $request)
    {
        $rules = [
            'member_id' => 'required|unique:order_members'
        ];

        $eMessage = [
            'member_id.required' => 'Pilih customer terlebih dahulu !',
            'member_id.unique' => 'Customer sudah anda pilih !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $addMember = new OrderMember;
        $addMember->member_id = $request->member_id;
        $addMember->save();
        
        return redirect()->back()->with('success', 'Customer berhasil ditambah !');
    }

    public function invoice($no_order)
    {
        $getTitle = Settings::find(1);
        $order = Order::with(['productOrder'])->where('no_order', $no_order)->first();

        return view('sales.transaction.invoice', compact('getTitle', 'order'));
    }


    // public function destroy(Transaction $transaction)
    // {
    //     $transaction->truncate();

    //     return redirect()->route('transaction.index')->with('success', 'Keranjang berhasil dikosongkan!');
    // }
}
