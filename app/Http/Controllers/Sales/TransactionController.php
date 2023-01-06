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
        $transaction = Transaction::with(['products'])->where('add_by', '=', auth()->user()->id)->get();

        //Check Product in Cart
        foreach ($transaction as $transaction) {
            if ($request->product_id == $transaction->product_id) {
                return redirect()->back()->with('warning', "Produk {$transaction->products->name} sudah ada dikeranjang!");
            }
        }
        //End

        $rules = [
            'product_id' => 'required'
        ];

        $eMessage = [
            'product_id.required' => 'Pilih produk terlebih dahulu !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $addProductToCart = new Transaction;
        $addProductToCart->product_id = $request->product_id;
        $addProductToCart->add_by = $request->add_by;
        $addProductToCart->qty = $request->qty;
        $addProductToCart->total = $request->total;
        $addProductToCart->save();
        
        return redirect()->back()->with('success', 'Produk berhasil ditambah keranjang!');
    }

    public function addMember(Request $request)
    {
        $orderMember = OrderMember::with('getMember')->where('add_by', '=', auth()->user()->id)->get();
        $count = $orderMember->count();

        $rules = [
            'member_id' => 'required|unique:order_members'
        ];

        $eMessage = [
            'member_id.required' => 'Pilih customer terlebih dahulu !',
            'member_id.unique'   => 'Customer sudah terpilih !',
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
        $addMember->add_by = $request->add_by;
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

    public function reportTransaction()
    {
        $store_information = Settings::find(1);
        return view('sales.transaction.report', compact('store_information'));
    }

    public function print(Request $request)
    {        
        $firstDate  = $request->firstDate;
        $lastDate   = $request->lastDate;
        $store_information = Settings::findOrFail(1);
        $query = Order::with(['productOrder'])
            ->whereDate('created_at', '>=' ,$firstDate )
                ->whereDate('created_at', '<=', $lastDate)
                    ->get();

        return view('sales.transaction.print', compact(['store_information','query', 'firstDate', 'lastDate']));
    }
}
