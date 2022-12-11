<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades;
use App\Models\{Products, Transaction, Order, OrderProduct, Members, OrderMember};

class Index extends Component
{
    public  $payment, $discount, $confirmDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteCart'];
    
    //Validation
    protected $rules = [
        'payment'     => 'required',
        'discount'  => 'required'
    ];

    protected $messages = [
        'payment.required' => 'isi nominal jumlah pembayaran'
    ];
    //End Validation

    public function clear() {
        $this -> payment = '';
        $this -> discount = '';
    }

    public function render()
    {
        $member = Members::all();
        $orderMember = OrderMember::with('getMember')->limit(1)->get();
        $transaction = Transaction::with(['products'])->get();
        $products = Products::orderBy('code_product', 'desc')->get();

        return view('livewire.transaction.index', compact(['transaction', 'products', 'member', 'orderMember']));
    }

    public function checkout()
    {
        $this->validate();

        $orderMember = OrderMember::get();
        $transaction = Transaction::with('products')->get();
        
        $order = Order::create([
            'no_order'      => 'INVOICE-'.date('Ymd').rand(1111,9999),
            'cashier_name'  => auth()->user()->name,
            'member_id'     => $orderMember->first()->member_id ?? 1,
            'sub_total'     => $transaction->sum('total'),
            'discount'      => $this->discount,
            'total'         => $transaction->sum('total') - $this->discount,
            'payment'       => $this->payment,
            'change_money'  => $this->payment - $transaction->sum('total') + $this->discount
        ]);

        foreach ($orderMember as $orderMember) {
            $member = array(
                'member_id'     => $orderMember->member_id,
                'created_at'    => $orderMember->created_at,
                'updated_at'    => $orderMember->updated_at, 
            );
            
            $deleteMember = OrderMember::where('id', $orderMember->id)->delete();
        }

        foreach ($transaction as $transaction) {
            $product = array(
                'order_id'       => $order->id,
                'product_id'     => $transaction->product_id,
                'qty'            => $transaction->qty, 
                'total'          => $transaction->total,
                'created_at'     => \Carbon\carbon::now(),
                'updated_at'     => \Carbon\carbon::now()
            );

            Products::find($transaction->product_id)->decrement('stok', $transaction->qty);

            $orderProduct = OrderProduct::insert($product);
            
            $deleteTransaction = Transaction::where('id', $transaction->id)->delete();
        }    

        $this->clear();

        return redirect()->route('transaction.invoice', [$order->no_order] )->with('success', 'Pembayaran berhasil');
    }

    public function plusQty($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'qty' => $transaction->qty + 1,
            'total' => $transaction->products->price_sell * ($transaction->qty + 1),
        ]);
        return redirect()->back();
    }

    
    public function minQty($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'qty' => $transaction->qty - 1,
            'total' => $transaction->products->price_sell * ($transaction->qty - 1)
        ]);
        return redirect()->back();
    }

    public function deleteConfirmation($id)
    {
        $this->confirmDelete = $id;
        $this->dispatchBrowserEvent('delete-confirm');
    }
    
    public function deleteCart()
    {
        $transaction = Transaction::where('id', $this->confirmDelete)->first();
        
        $transaction->delete();
        
        return redirect()->route('transaction.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }

    public function deleteMember()
    {
        $deleteMember = OrderMember::get();

        foreach ($deleteMember as $data) {
            $member = array(
                'member_id'     => $data->first()
            );
            
            $delete = OrderMember::where('id', $data->id)->delete();
        }
        
        return redirect()->route('transaction.index')->with('success', 'Member berhasil dikosongkan');
    }

    public function nullCart()
    {
        $transaction = Transaction::get();

        foreach ($transaction as $transaction) {
            $product = array(
                'product_id'     => $transaction->product_id, 
            );
            $deleteTransaction = Transaction::where('id', $transaction->id)->delete();
        }
        
        return redirect()->route('transaction.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
