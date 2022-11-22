<?php

namespace App\Http\Controllers\Main;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\{Settings, SystemUpdate, SystemCategories};

class SystemUpdateController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('system-info', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:system-info')->except(['create','edit']);
    }

    public function index(Request $request)
    {
        if($request->has('search')){
            // $systemUpdate = SystemUpdate::where('desc', 'LIKE', '%'.$request->search.'%')->paginate(5);
            $systemUpdate = SystemUpdate::with(['category'])->where('category_id', 'LIKE', '%'.$request->search.'%')
                ->orWhere('desc', 'LIKE', '%'.$request->search.'%')
                    ->paginate(5);
        }else{
            $systemUpdate = SystemUpdate::with(['category'])->orderBy('id', 'desc')->paginate(5);
        }

        $getTitle     = Settings::find(1);
        $categories = SystemCategories::all();
        
        return view('main.index_system_update',compact('categories','getTitle', 'systemUpdate'));
    }

    public function store(Request $request)
    {
        $SystemUpdate = new SystemUpdate();
        $SystemUpdate->category_id = $request->category_id;
        $SystemUpdate->desc = $request->desc;
        $SystemUpdate->created_at = $request->created_at;
        $SystemUpdate->updated_at = $request->updated_at;
        $SystemUpdate->save();

        return redirect()->route('system-info.index')->with('success', 'Data berhasil ditambah !');
    }

    public function show($id)
    {
        $getTitle = Settings::find(1);
        $systemUpdate = SystemUpdate::find($id);
        $categories = SystemCategories::all();

        return view('main.show_system_update', compact('getTitle', 'systemUpdate', 'categories'));
    }

    public function update(Request $request, $id)
    {   

        SystemUpdate::find($id)->update($request->all());

        return redirect()->route('system-info.index')->with('success', 'Data berhasil diubah !');
    }

    public function destroy($id)
    {  
        SystemUpdate::find($id)->delete();
        // $systemUpdate->delete();
        return redirect()->route('system-info.index')->with('success', 'Data berhasil dihapus !');
    }
}
