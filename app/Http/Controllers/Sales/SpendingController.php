<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\{Spending, Settings};
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Access\Gate;

class SpendingController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('spending', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:spending')->except(['show']);
    }

    public function index()
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);
        $spending = Spending::orderBy('id', 'DESC')->get();
        return view('sales.spending.index', compact('store_information','spending'));
    }

    public function create()
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);

        return view('sales.spending.create', compact('store_information'));
    }

    public function store(Request $request)
    {
        $rules = [
            'desc'    => 'required',
            'nominal' => 'required',
        ];

        $eMessage = [
            'desc.required'    => 'Deksripsi harus di isi !',
            'nominal.required' => 'Jumlah nominal harus di isi !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $spending = new Spending();
        $spending->desc       = $request->desc;
        $spending->nominal    = $request->nominal;
        $spending->created_at = $request->created_at;
        $spending->save();

        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil ditambah !');
    }

    public function edit(Spending $spending)
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);

        return view('sales.spending.edit', compact('store_information','spending'));
    }

    public function update(Request $request, Spending $spending)
    {
        $rules = [
            'desc'    => 'required',
            'nominal' => 'required',
        ];

        $eMessage = [
            'desc.required'    => 'Deksripsi harus di isi !',
            'nominal.required' => 'Jumlah nominal harus di isi !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $spending->desc       = $request->desc;
        $spending->nominal    = $request->nominal;
        $spending->created_at = $request->created_at;

        if (!$spending->isDirty()){
            return redirect()->back()->with('warning', 'Tidak ada data yang diubah !');
        }

        $spending->update();

        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil diubah !');
    }

    public function destroy(Spending $spending)
    {
        $spending->delete();

        return redirect()->route('spending.index')->with('success', 'Data pengeluaran berhasil dihapus !');
    }

    public function reportSpending()
    {
        $store_information = Settings::findOrFail(1);
        return view('sales.spending.report', compact('store_information'));
    }

    public function print(Request $request)
    {
        $firstDate = $request->input('firstDate');
        $lastDate = $request->input('lastDate');
        
        $query = Spending::whereBetween('created_at', [$firstDate, $lastDate])->get();
        $store_information = Settings::findOrFail(1);
        // dd("Tanggal Awal : ".$firstDate, "Tanggal Akhir :".$lastDate);
        // $spending = Spending::whereBetween('created_at', [$firstDate, $lastDate])->get();
        return view('sales.spending.print', compact('store_information','query', 'firstDate', 'lastDate'));
    }
}
