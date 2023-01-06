<?php

namespace App\Http\Livewire\Purchase;

use Livewire\Component;
use App\Models\{ Products, 
    PurchaseTransaction, 
    PurchaseSupplier,
    PurchaseProducts,
    PurchaseOrder,
    Supplier, 
};

class Index extends Component
{
    public $payment, $update_qty, $discount = 0;

    protected $rules = [
        'purchase_order' => 'required',
        'payment'        => 'required'
    ];

    protected $messages = [
        'payment.required'     =>  'isi nominal jumlah pembayaran',
    ];

    protected $listeners = ['deleteConfirmed' => 'deleteCart'];

    public function mount()
    {
        $this->supplier = Supplier::all();
        $this->supplier_purchase = PurchaseSupplier::all();
        $this->purchase_order= $this->generateOrder();
    }

    public function render()
    {
        $products = Products::orderBy('id', 'ASC')->get();
        $purchase = PurchaseTransaction::with(['products'])->get();

        return view('livewire.purchase.index', compact(['products', 'purchase']));
    }

    public function clear()
    {
        $this->discount = 0 ;
        $this->payment  = '';
    }

    public function generateOrder()
    {
        $purchase_order = 'ORDER-'.date('Ymd').rand(1111,9999);
        return $purchase_order;
    }

    public function updateQty($id)
    {
        $purchase = PurchaseTransaction::find($id);

        if($this->update_qty == 0){
            return redirect()->route('purchase.index')->with('error', 'Isi jumlah produk yang ingin dibeli terlebih dahulu');
        }
        
        $purchase->update([
            'qty'   => $this->update_qty,
            'total' => $purchase->products->price_buy * $this->update_qty,
        ]);
        return redirect()->route('purchase.index')->with('success', 'Produk yang dipilih berhasil diupdate');
    }

    public function checkout()
    {
        $this->validate();

        $getSupplier = PurchaseSupplier::get();
        $purchase = PurchaseTransaction::with('products')->get();
        $count = $purchase->count();

        if($count == 0)
        {
            return redirect()->route('purchase.index')->with('error', 'Tidak dapat melanjutkan pembelian, pilih produk yang ingin dibeli terlebih dahulu!');
        }
        else if($purchase->sum('total') - $this->discount > $this->payment)
        {
            return redirect()->route('purchase.index')->with('error', 'Uang tidak cukup untuk melanjutkan pembelian produk');
        }else if($purchase->sum('total') - $this->discount < $this->payment)
        {
            return redirect()->route('purchase.index')->with('error', 'Pembayaran lebih besar dari pada total yang harus dibayar, Bayar dengan nominal pas!');
        }
        else
        {
            $order = PurchaseOrder::create([
                'purchase_order'=> $this->purchase_order,
                'purchase_by'   => auth()->user()->name,
                'supplier_id'   => $getSupplier->first()->supplier_id ?? 1,
                'discount'      => $this->discount,
                'total'         => $purchase->sum('total'),
                'payment'       => $this->payment,
            ]);

            foreach ($getSupplier as $getSupplier) {
                $deleteMember = PurchaseSupplier::where('id', $getSupplier->id)->delete();
            }

            foreach ($purchase as $purchase) {
                $product = array(
                'purchase_id'    => $order->id,
                'product_id'     => $purchase->product_id,
                'qty'            => $purchase->qty, 
                'total'          => $purchase->total,
                'created_at'     => \Carbon\carbon::now(),
                'updated_at'     => \Carbon\carbon::now()
                );

                $purchaseProduct = PurchaseProducts::insert($product);
                Products::find($purchase->product_id)->increment('stok', $purchase->qty);
                $deleteTransaction = PurchaseTransaction::where('id', $purchase->id)->delete();
            } 
        }
        $this->clear();

        return redirect()->route('purchase.invoice',  [$order->purchase_order])->with('success', 'Pembelian produk berhasil');
    }

    public function deleteConfirmation($id)
    {
        $this->confirmDelete = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }

    public function deleteCart()
    {
        $purchase = PurchaseTransaction::where('id', $this->confirmDelete)->first();
        
        $purchase->delete();
        
        return redirect()->route('purchase.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function deleteSupplier()
    {
        $deleteSupplier = PurchaseSupplier::get();

        foreach ($deleteSupplier as $data) {
            $delete = PurchaseSupplier::where('id', $data->id)->delete();
        }
        
        return redirect()->route('purchase.index')->with('success', 'Supplier berhasil dikosongkan');
    }

    public function nullCart()
    {
        $purchase = PurchaseTransaction::get();

        foreach ($purchase as $purchase) {
            $deleteTransaction = PurchaseTransaction::where('id', $purchase->id)->delete();
        }
        
        return redirect()->route('purchase.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
