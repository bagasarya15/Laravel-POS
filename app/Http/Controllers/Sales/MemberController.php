<?php

namespace App\Http\Controllers\Sales;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ DB, Validator };
use App\Http\Controllers\Controller;

class MemberController extends Controller
{

    public function index()
    {
        $member = Members::latest()->get();
        return view('sales.member.index', compact('member'));
    }

    public function create()
    {
        // Auto Number Function Start // 
        $table = DB::table('members')->select(DB::raw('MAX(RIGHT(code_member, 5)) AS code'));
        $AutoNumber = "";
        if($table->count()>0){
            foreach ($table->get() as $tbl ) {
                $tmp = ((int)$tbl->code)+1;
                $AutoNumber = sprintf("%05s", $tmp);
            }
        }else{
            $AutoNumber = "00001";
        }
        // Auto Number End //
        return view('sales.member.create', compact('AutoNumber'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
        ];

        $eMessage = [
            'name.required' => 'Nama member harus di isi !'
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
        $member->save();

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambah !');
    }

    public function show($id)
    {
        //
    }

    public function edit(Members $member)
    {
        return view('sales.member.edit', compact('member'));
    }

    public function update(Request $request, Members $member)
    {   
        $rules = [
            'name' => 'required',
        ];

        $eMessage = [
            'name.required' => 'Nama member harus di isi !'
        ];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $member->update([
            'code_member' => $request->code_member,
            'name' => $request->name,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
        ]);
        
        return redirect()->route('member.index')->with('success', 'Member berhasil diubah !');
    }

    public function destroy(Request $request, Members $member)
    {
        $member->delete();
        
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus !');
    }
}
