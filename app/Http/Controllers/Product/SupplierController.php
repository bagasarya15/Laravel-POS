<?php

namespace App\Http\Controllers\Product;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Access\Gate;

class SupplierController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('supplier', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:supplier')->except(['show']);
    }
    
    public function index()
    {
        $supplier = Supplier::all();
        return view('product.supplier.index', compact('supplier'));
    }

    public function create()
    {
        return view('product.supplier.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name'         => 'required',
            'address'      => 'nullable',
            'number_phone' => 'required|unique:suppliers,number_phone',
            'desc'         => 'nullable'
        ];

        $eMessage = [
            'name.required'         => 'Nama supplier harus di isi !',
            'number_phone.required' => 'No tlp harus di isi !',
            'number_phone.unique'   => 'No tlp sudah terdata, coba dengan nomor lain !'
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->number_phone = $request->number_phone;
        $supplier->desc = $request->desc;
        $supplier->save();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambah !');
    }

    public function edit(Supplier $supplier)
    {
        return view('product.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        if ($request->number_phone != $supplier->number_phone){
            $number_rules = ['required', 'unique:suppliers,number_phone'];
        }else{
            $number_rules = ['required'];
        }

        $rules = [
            'name'         => 'required',
            'address'      => 'nullable',
            'number_phone' => $number_rules,
            'desc'         => 'nullable'
        ];

        $eMessage = [
            'name.required'         => 'Nama supplier harus di isi !',
            'number_phone.required' => 'No tlp harus di isi !',
            'number_phone.unique'   => 'No tlp sudah terdata, coba dengan nomor lain !'
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $supplier->update([
            'name'          => $request->name,
            'address'       => $request->address,
            'number_phone'  => $request->number_phone,
            'desc'          => $request->desc,
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diubah !');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus !');
    }
}
