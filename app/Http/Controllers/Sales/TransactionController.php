<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\{ DB, Validator };
use App\Models\{Settings, Products, Transaction, Order, OrderProduct, Members, OrderMember};


class TransactionController extends Controller
{
    public function index()
    {
        $store_information = Settings::find(1);
        return view('sales.transaction.index', compact('store_information'));
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
        $orderMember = OrderMember::with('getMember')->get();
        $count = $orderMember->count();

        $rules = [
            'member_id' => 'required|unique:order_members'
        ];

        $eMessage = [
            'member_id.required' => 'Pilih customer terlebih dahulu !',
            'member_id.unique' => 'Customer sudah anda pilih !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        foreach ($orderMember as $order) {
            if ($count > 0) {
                return redirect()->back()->with('error', "Terdapat customer {$order->getMember->name} sudah di input, hapus terlebih dahulu jika ingin mengganti customer!");
            }
        }

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
        $store_information = Settings::find(1);
        $order = Order::with(['productOrder'])->where('no_order', $no_order)->first();

        return view('sales.transaction.invoice', compact('store_information', 'order'));
    }

    public function dataTransaction()
    {
        $store_information = Settings::find(1);
        $order = Order::with(['productOrder'])->orderBy('id', 'DESC')->get();
        $orderProduct = OrderProduct::with(['getProduct', 'getOrder'])->orderBy('id', 'DESC')->get();
        
        return view('sales.transaction.data_transaction', compact(['store_information','order', 'orderProduct']));
    }
}
