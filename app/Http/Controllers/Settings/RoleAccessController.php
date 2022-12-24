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
        $store_information = Settings::find(1);
        $user = User::with(['role'])->orderBy('id', 'asc')->get();
        $role = UserRole::all();
        return view('setting.role_index', compact('store_information','user', 'role'));
    }

    public function store(Request $request)
    {
        $rules = [
            'username'         => 'required|unique:users,username', 
            'name'             => 'required',
            'password'         => 'required_with:confirm_password|same:confirm_password|min:5',
            'confirm_password' => 'min:5',
        ];

        $eMessage = [
            'name.required'             => 'Isi nama terlebih dahulu !',
            'username.required'         => 'Isi username terlebih dahulu !',
            'username.unique'           => 'Username sudah terpakai, coba lagi !',
            'password.required'         => 'Isi password terlebih dahulu !',
            'password.min:5'            => 'Password minimal 5 huruf atau angka !',
            'password.same'             => 'Password tidak sama coba lagi !'
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }
        
        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->image = $request->image;
        $user->save();

        return redirect()->back()->with('success', 'Data user berhasil dibuat !');
    }
        
    public function show(User $user_access)
    {
        $store_information = Settings::find(1);
        $role = UserRole::all();
        return view('setting.role_show', compact('user_access', 'store_information', 'role'));
    }

    public function resetPassword(User $user_access)
    {
        $user_access->update([
            'password' => Hash::make('user12345')
        ]);
        
        return redirect()->back()->with('success', 'Password berhasil direset !');
    }

    public function update(Request $request, User $user_access)
    {
        if ($request->username != $user_access->username){
            $username = ['required', 'unique:users,username'];
        }else{
            $username = ['required'];
        }

        if ($request->email != $user_access->email){
            $email= ['unique:users,email'];
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

    public function destroy(User $user_access)
    {
        if($user_access->id == 1 || $user_access->id == 2){
            return redirect()->back()->with('info', 'Tidak dapat menghapus, user yang dipilih merupakan SuperAdmin');
        }
        
        $user_access->delete();   
        
        return redirect()->route('user-access.index')->with('success', 'User yang dipilih berhasil dihapus !');
    }
}
