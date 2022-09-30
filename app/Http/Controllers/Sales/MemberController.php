<?php

namespace App\Http\Controllers\Sales;

use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member = Members::latest()->get();
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
        return view('sales.member.index', compact('member', 'AutoNumber'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = new Members();
        $member->code_member = $request->code_member;
        $member->name = $request->name;
        $member->address = $request->address;
        $member->number_phone = $request->number_phone;

        $member->save();

        return redirect()->route('member.index')->with('success', 'Member berhasil ditambah !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::findOrFail($id);
        return response()->json([
            "success" => true,
            "message" => "Get dafa successfully",
            "data" => $member,
        ]);

        // return view('sales.member.index', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Members $member)
    {
        return view('sales.member.index', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Members $member)
    {
        $member->update([
            'code_member' => $request->code_member,
            'name' => $request->name,
            'address' => $request->address,
            'number_phone' => $request->number_phone,
        ]);
        return redirect()->route('member.index')->with('success', 'Member berhasil diubah !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Members $member)
    {
        $member->delete();
        
        return redirect()->route('member.index')->with('success', 'Member berhasil dihapus!');
    }
}
