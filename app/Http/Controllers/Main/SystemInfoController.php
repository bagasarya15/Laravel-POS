<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{DB, Validator};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\{Settings, SystemInfo, SystemCategories};

class SystemInfoController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('system-info', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:system-info')->except(['create','edit']);
    }

    // public function index(Request $request)
    // {
    //     if($request->has('search')){
    //         // $systemUpdate = SystemUpdate::where('desc', 'LIKE', '%'.$request->search.'%')->paginate(5);
    //         $systemInfo = SystemInfo::with(['category'])->where('category_id', 'LIKE', '%'.$request->search.'%')
    //             ->orWhere('desc', 'LIKE', '%'.$request->search.'%')
    //                 ->paginate(5);
    //     }else{
    //         $systemInfo = SystemInfo::with(['category'])->orderBy('id', 'desc')->paginate(5);
    //     }

    //     $getTitle     = Settings::find(1);
    //     $categories = SystemCategories::all();
        
    //     return view('main.index_system_info',compact('categories','getTitle', 'systemInfo'));
    // }

    public function index()
    {
        $store_information = Settings::find(1);
        $categories = SystemCategories::all();
        $data = SystemInfo::with('category')->orderBy('id', 'DESC')->get();

        return view('main.index_system_info',compact('store_information', 'data', 'categories'));
    }

    public function store(Request $request)
    {

        $rules = ['desc' => 'unique:system_information,desc'];

        $eMessage = ['desc.unique' => 'Data keterangan update sudah ada didatabase, coba buat kalimat yang berbeda ! '];
        
        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
        return redirect()->back()->with('warning', $validator->errors()->first());
        }
        
        $SystemInfo = new SystemInfo();
        $SystemInfo->category_id = $request->category_id;
        $SystemInfo->desc = $request->desc;
        $SystemInfo->created_at = $request->created_at;
        $SystemInfo->updated_at = $request->updated_at;
        $SystemInfo->save();

        return redirect()->route('system-info.index')->with('success', 'Data berhasil ditambah !');
    }

    public function show($id)
    {
        $store_information = Settings::find(1);
        $systemInfo= SystemInfo::find($id);
        $categories = SystemCategories::all();

        return view('main.show_system_info', compact('store_information', 'systemInfo', 'categories'));
    }

    public function update(Request $request, $id)
    {   

        SystemInfo::find($id)->update($request->all());

        return redirect()->route('system-info.index')->with('success', 'Data berhasil diubah !');
    }

    public function destroy($id)
    {  
        SystemInfo::find($id)->delete();
        // $systemUpdate->delete();
        return redirect()->route('system-info.index')->with('success', 'Data berhasil dihapus !');
    }
}
