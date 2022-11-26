<?php

namespace App\Http\Controllers\Settings;

use App\Models\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Support\Facades\{ Validator, Storage };

class SettingController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('settings', fn($user) => $user->role_id == 1 || $user->role_id == 2);

        $this->middleware('can:settings')->except(['create','store','edit','destroy']);
    }

    public function index()
    {
        //Variabel For Title Menu
        $getTitle = Settings::find(1);
        $settings = Settings::all();
        return view('setting.index', compact('getTitle','settings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Settings $setting)
    {
        //Variabel For Title Menu
        $getTitle = Settings::find(1);

        return view('setting.show', compact('getTitle','setting',));
    }

    public function edit()
    {
        //
    }

    public function update(Request $request, Settings $setting)
    {
        $rules = [
            'name'       => 'required',
            'address'    => 'required',
            'image'      => 'file|image|mimes:jpg,png|max:1024',
        ];

        $eMessage = [
            'name.required'     => 'Nama toko tidak boleh kosong !',
            'address.required'  => 'Alamat tidak boleh kosong !',
            'image.image'        => 'Gambar Harus Berupa File Image !',
            'image.mimes'        => 'Gambar Yang Diupload Hanya Berupa JPG & PNG !',
            'image.max'          => 'Ukuran Gambar Max 1mb !',
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $setting->name          = $request->name;   
        $setting->address       = $request->address;
        $setting->owner_name    = $request->owner_name ;
        $setting->number_phone  = $request->number_phone;

        if ($request->hasFile('image')){
            if ($setting->image != 'logo/default.png'){
                Storage::disk('public')->delete($setting->image);
            }
            $setting->image = Storage::disk('public')->putFile('logo', $request->file('image'));
        }

        if (!$setting->isDirty()){
            return redirect()->back()->with('warning', 'Tidak ada data yang diubah !');
        }
        
        $setting->update();

        return redirect()->route('settings.index')->with('success', 'Data toko berhasil diubah !');
    }

    public function destroy($id)
    {
        //
    }
}
