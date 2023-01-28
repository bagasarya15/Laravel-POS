<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\{Settings, PurchaseTransaction, PurchaseOrder, PurchaseProducts, PurchaseSupplier, Order};

class PurchaseController extends Controller
{
    public function index()
    {
        $store_information = Settings::find(1);
        
        return view('sales.purchase.index', compact('store_information'));
    }

    public function store(Request $request)
    {   

        $purchase = PurchaseTransaction::with(['products'])->where('add_by', '=', auth()->user()->id)->get();

        // Check If Same Product Id In Cart
        foreach ($purchase as $purchase) {
            if($request->supplier_id == $purchase->supplier_id){
                return redirect()->back()->with('warning', "Produk {$purchase->products->name} sudah ada dikeranjang!");
            }
        }
        //End

        $rules = [
            'add_by'     => 'required',
        ];

        $eMessage = [
            'product_id.required' => 'Pilih produk terlebih dahulu !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $purchase = new PurchaseTransaction;
        $purchase->product_id = $request->product_id;
        $purchase->qty = $request->qty;
        $purchase->total = $request->total;
        $purchase->add_by = $request->add_by;
        $purchase->save();
        
        return redirect()->back()->with('success', 'Produk berhasil ditambah keranjang!');
    }

    public function dataPurchase()
    {
        if(auth()->user()->role_id == 3)
        {
            return view('errors.403');
        }
        
        $store_information = Settings::find(1);
        $purchase          = PurchaseOrder::with(['getSupplier'])->orderBy('id', 'DESC')->get();
        $purchaseProduct   = PurchaseProducts::with(['getOrder', 'getProduct'])->orderBy('id', 'DESC')->get();

        return view('sales.purchase.data_purchase', compact(['store_information', 'purchase', 'purchaseProduct']));
    }

    public function purchaseInvoice($purchase_order)
    {
        $store_information = Settings::find(1);
        $purchase = PurchaseOrder::with(['getSupplier', 'productOrder'])->where('purchase_order', $purchase_order)->first();
        return view('sales.purchase.purchase_invoice',compact('store_information', 'purchase'));
    }

    public function reportPurchase()
    {
        $store_information = Settings::find(1);
        return view('sales.purchase.report', compact('store_information'));
    }

    public function print(Request $request)
    {        
        $tglAwal  = $request->tglAwal;
        $tglAkhir = $request->tglAkhir;
        $store_information = Settings::findOrFail(1);
        $query = PurchaseOrder::with(['getSupplier'])
            ->whereDate('created_at', '>=' ,$tglAwal )
                ->whereDate('created_at', '<=', $tglAkhir)
                    ->get();

        return view('sales.purchase.print', compact(['store_information','query', 'tglAwal', 'tglAkhir']));
    }

    public function addSupplier(Request $request)
    {

        $supplier = PurchaseSupplier::with(['getSupplier'])->where('add_by', '=', auth()->user()->id)->get();

        foreach ($supplier as $supplier) {
            if($supplier->count() > 1){
                return redirect()->back()->with('warning', ' '.$supplier->getSupplier->name.' sudah diinput ');
            }
        }

        $add              = new PurchaseSupplier;
        $add->supplier_id = $request->supplier_id;
        $add->add_by      = $request->add_by;
        $add->save();
        
        return redirect()->back()->with('success', 'Supplier berhasil ditambah !');
    }
}
