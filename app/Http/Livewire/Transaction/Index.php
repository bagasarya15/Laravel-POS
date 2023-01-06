<?php

namespace App\Http\Livewire\Transaction;

use Livewire\Component;
use Illuminate\Support\Facades;
use App\Models\{Products, 
    Transaction, 
    Order, 
    OrderProduct, 
    Members, 
    OrderMember,
};

class Index extends Component
{
    public $payment, $discount, $confirmDelete;

    protected $listeners = ['deleteConfirmed' => 'deleteCart'];

    protected $rules = [
        'payment'   => 'required',
        'discount'  => 'required',
        'no_order'  => 'required|unique:orders,no_order'
    ];

    protected $messages = [
        'payment.required'  => 'isi nominal jumlah pembayaran',
        'discount.required' => 'pilih discount',
        'no_order.unique'   => 'Nomer order sudah digunakan, refresh untuk generate kode baru'
    ];
    
    public function mount()
    {
        $this->no_order = $this->generateOrder();
    }

    public function clear() {
        $this -> payment = '';
    }

    public function generateOrder()
    {
        $no_order = 'INVOICE-'.date('Ymd').rand(1111,9999);
        return $no_order;
    }

    public function render()
    {
        $member      = Members::all();
        $orderMember = OrderMember::with(['getMember'])->where('add_by', '=', auth()->user()->id)->get();
        $transaction = Transaction::with(['products'])->where('add_by', '=', auth()->user()->id)->get();
        $products    = Products::orderBy('id', 'ASC')->get();
        return view('livewire.transaction.index', compact(['transaction', 'products', 'member', 'orderMember']));
    }

    public function checkout(Order $check)
    {
        $this->validate();

        $orderMember = OrderMember::get();
        $transaction = Transaction::with(['products'])->where('add_by', '=', auth()->user()->id)->get();
        $count       = $transaction->count();

        if($count == 0){
            return redirect()->route('transaction.index')->with('error', 'Tidak dapat melanjutkan transaksi, pilih produk yang ingin dibeli terlebih dahulu!');
        }else if($transaction->sum('total') - $this->discount > $this->payment){
            return redirect()->route('transaction.index')->with('error', 'Uang tidak cukup untuk melanjutkan transaksi');
        }else{
            $order = Order::create([
                'no_order'      => $this->no_order,
                'cashier_name'  => auth()->user()->name,
                'member_id'     => $orderMember->first()->member_id ?? 1 ,
                'sub_total'     => $transaction->sum('total'),
                'discount'      => $this->discount,
                'total'         => $transaction->sum('total') - $this->discount,
                'payment'       => $this->payment,
                'change_money'  => $this->payment - $transaction->sum('total') + $this->discount
            ]);

            foreach ($transaction as $transaction) {
                $product = array(
                    'order_id'       => $order->id,
                    'product_id'     => $transaction->product_id,
                    'qty'            => $transaction->qty,
                    'total'          => $transaction->total,
                    'created_at'     => \Carbon\carbon::now(),
                    'updated_at'     => \Carbon\carbon::now(),
                );

                Products::find($transaction->product_id)->decrement('stok', $transaction->qty);
                $orderProduct = OrderProduct::insert($product);
            }     
        }

        $this->nullCart();
        $this->deleteMember();
        $this->clear();

        return redirect()->route('transaction.invoice', [$order->no_order] );
    }

    public function plusQty($id)
    {
        $transaction = Transaction::with(['products'])->find($id);
        
        if($transaction->qty >= $transaction->products->stok){
            return redirect()->back();
        }

        $transaction->update([
            'qty' => $transaction->qty + 1,
            'total' => $transaction->products->price_sell * ($transaction->qty + 1),
        ]);
        
        return redirect()->back();
    }

    public function minQty($id)
    {
        $transaction = Transaction::with(['products'])->find($id);

        if($transaction->qty <= 1){
            return redirect()->back();
        }

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
        $deleteMember = OrderMember::where('add_by', '=', auth()->user()->id)->delete();       
        
        return redirect()->route('transaction.index')->with('success', 'Member berhasil dikosongkan');
    }

    public function nullCart()
    {
        $deleteTransaction = Transaction::where('add_by', '=', auth()->user()->id )->delete();

        // $transaction = Transaction::get();
        
        // foreach ($transaction as $transaction) {
        //     $product = array(
        //         'product_id'     => $transaction->product_id, 
        //     );
        //     $deleteTransaction = Transaction::where('id', $transaction->id)->delete();
        // }
        
        return redirect()->route('transaction.index')->with('success', 'Keranjang berhasil dikosongkan');
    }
}
