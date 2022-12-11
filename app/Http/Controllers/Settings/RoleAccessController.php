<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Access\Gate;
use App\Models\{ User, UserRole, Settings};
use Illuminate\Support\Facades\{ Hash, Validator, Storage };

class RoleAccessController extends Controller
{
    public function __construct(Gate $gate) 
    {
        $gate->define('user-access', fn($user) => $user->role_id == 1);

        $this->middleware('can:user-access')->except(['create','store','edit','destroy']);
    }
    
    public function index()
    {
        $getTitle = Settings::find(1);
        $user = User::with(['role'])->orderBy('id', 'asc')->get();
        return view('setting.role_index', compact('getTitle','user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user_access)
    {
        $getTitle = Settings::find(1);
        $role = UserRole::all();
        return view('setting.role_show', compact('user_access', 'getTitle', 'role'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $user_access)
    {
        if ($request->username != $user_access->username){
            $username = ['required', 'unique:users,username'];
        }else{
            $username = ['required'];
        }

        if ($request->email != $user_access->email){
            $email= ['required', 'unique:users,email'];
        }else{
            $email= ['required'];
        }

        $rules = [
            'username'    => $username,
            'name'        => 'required',
            'email'       => $email,
        ];

        $eMessage = [
            'username.required'  => 'Username tidak boleh kosong !',
            'username.unique'    => 'Username sudah terpakai, coba lagi !',
            'name.required'      => 'Nama tidak boleh kosong !',
            'email.required'     => 'Email tidak boleh kosong !',
            'email.unique'       => 'Email sudah terpakai, coba lagi !',
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $user_access->username   = $request->username;
        $user_access->name       = $request->name;   
        $user_access->email      = $request->email;
        $user_access->role_id    = $request->role_id;

        if (!$user_access->isDirty()){
            return redirect()->back()->with('warning', 'Tidak ada data yang diubah !');
        }
        
        $user_access->update();
        
        // return redirect()->route('user-access.index')->with('success', 'Data users berhasil diupdate !');
        return redirect()->back()->with('success', 'Data users berhasil diupdate !');
    }

    public function destroy($id)
    {
        //
    }
}