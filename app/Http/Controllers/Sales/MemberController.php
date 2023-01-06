<?php

namespace App\Http\Controllers\Sales;

use App\Models\{Members, Settings};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\{ DB, Validator };

class MemberController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('member', fn($user) => $user->role_id == 1 || $user->role_id == 2 || $user->role_id == 3);

        $this->middleware('can:member')->except(['show']);
    }
    
    public function index()
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);;
        $member = Members::oldest()->get();
        return view('sales.member.index', compact('store_information','member'));
    }

    public function create()
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);

        // Auto Number Function Start // 
        $generateCode = 'MBR-'.date('Ymd').rand(1111,9999);
        // Auto Number End //
        return view('sales.member.create', compact(['store_information','generateCode']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'member_status' => 'required',
            'code_member' => 'unique:members,code_member'
        ];

        $eMessage = [
            'name.required' => 'Nama member harus di isi !',
            'member_status.required' => 'Status member harus di isi !',
            'code_member.unique'    => 'Code member sudah terpakai !'
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $member = new Members();
        $member->code_member = $request->code_member;
        $member->name = $request->name;
        $member->address = $request->address;
        $member->number_phone = $request->number_phone;
        $member->member_status = $request->member_status;
        $member->save();

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambah !');
    }

    public function show($id)
    {
        //
    }

    public function edit(Members $member)
    {
        //Variabel For Title Menu
        $store_information = Settings::findOrFail(1);

        return view('sales.member.edit', compact('store_information','member'));
    }

    public function update(Request $request, Members $member)
    {   
        $rules = [
            'name' => 'required',
            'member_status' => 'required'
        ];

        $eMessage = [
            'name.required' => 'Nama member harus di isi !',
            'member_status.required' => 'Status member harus di isi !',
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if($member->id == 1){
            return redirect()->back()->with('info', 'Tidak dapat mengubah data member '.$member->name.', karena merupakan data default sistem');
        }

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $member->update([
            'code_member' => $request->code_member,
            'name' => $request->name,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
            'member_status' => $request->member_status
        ]);
        
        return redirect()->route('member.index')->with('success', 'Member berhasil diubah !');
    }

    public function destroy(Request $request, Members $member)
    {
        $count = $member->memberOrder->count();

        if($count > 0){
            return redirect()->back()->with('info', 'Tidak dapat menghapus data member '. $member->name .', terdapat '.$count.' order di data penjualan');
        }else if($member->id == 1){
            return redirect()->back()->with('info', 'Tidak dapat menghapus data member '.$member->name.', karena merupakan data default sistem');
        }else{
            $member->delete();
        }
        // return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus !');
    }
}
