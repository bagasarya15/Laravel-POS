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
        $gate->define('member', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:member')->except(['show']);
    }
    
    public function index()
    {
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);;
        $member = Members::latest()->get();
        return view('sales.member.index', compact('getTitle','member'));
    }

    public function create()
    {
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);

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
        return view('sales.member.create', compact('getTitle','AutoNumber'));
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
        //Variabel For Title Menu
        $getTitle = Settings::findOrFail(1);

        return view('sales.member.edit', compact('getTitle','member'));
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
