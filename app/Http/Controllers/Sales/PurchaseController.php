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
        $rules = [
            'product_id' => 'required|unique:purchase_transactions'
        ];

        $eMessage = [
            'product_id.required' => 'Pilih produk terlebih dahulu !',
            'product_id.unique' => 'Produk sudah ada dikeranjang !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $purchase = new PurchaseTransaction;
        $purchase->product_id = $request->product_id;
        $purchase->qty = $request->qty;
        $purchase->total = $request->total;
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
        $supplierOrder = PurchaseSupplier::with(['getSupplier'])->get();
        $count = $supplierOrder->count();

        $rules = [
            'supplier_id' => 'unique:purchase_suppliers,id'
        ];

        $eMessage = [
            'supplier_id.unique' => 'Supplier sudah anda pilih !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        foreach ($supplierOrder as $order) {
            if ($count > 0) {
                return redirect()->back()->with('error', "Terdapat supplier {$order->getSupplier->name} sudah di input, hapus terlebih dahulu jika ingin mengganti supplier!");
            }
        }

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $add              = new PurchaseSupplier;
        $add->supplier_id = $request->supplier_id;
        $add->save();
        
        return redirect()->back()->with('success', 'Supplier berhasil ditambah !');
    }
}
