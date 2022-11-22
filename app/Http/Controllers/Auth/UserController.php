<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\{ User, Settings};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{ Validator, Storage };

class UserController extends Controller
{
    public function index()
    {
        $getTitle = Settings::findOrFail(1);
        $user = auth()->user()->id;
        return view('auth.profile', compact('getTitle','user'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        if ($request->username != $user->username){
        $username_rule = ['required', 'string', 'max:255', 'unique:users,username'];
        }else{
        $username_rule = ['required'];
        }

        if ($request->email != $user->email){
        $email_rule = ['required', 'string', 'email', 'max:255', 'unique:users,email'];
        }else{
        $email_rule = ['required'];
        }

        $rules = [
            'username' => $username_rule,
            'name'     => 'required',
            'email'    => $email_rule,
            'image'    => 'file|image|mimes:jpg,png|max:1024',
        ];

        $eMessage = [
            'username.required' => 'Username tidak boleh kosong !',
            'username.unique'   => 'Username sudah digunakan !',
            'name.required'     => 'Nama tidak boleh kosong !',
            'email.required'    => 'Email tidak boleh kosong !',
            'email.unique'      => 'Email sudah digunakan !',
            'image.image'       => 'Gambar Harus Berupa File Image !',
            'image.mimes'       => 'Gambar Yang Diupload Hanya Berupa JPG & PNG !',
            'image.max'         => 'Ukuran Gambar Max 1mb !', 
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $user->username = $request->username;
        $user->name     = $request->name; 
        $user->password = $request->password; 
        $user->email    = $request->email;
        $user->role_id    = $request->role_id;

        if ($request->hasFile('image')){
            if ($user->image != 'avatar/default.jpg'){
                Storage::disk('public')->delete($user->image);
            }
            $user->image = Storage::disk('public')->putFile('avatar', $request->file('image'));
        }

        if (!$user->isDirty()){
            return redirect()->back()->with('warning', 'Tidak ada data yang diubah !');
        }
        $user->update();
        
        return redirect()->route('user.index', $user)->with('success', 'Profile berhasil diubah !');
    }

    public function destroy($id)
    {
        //
    }
}
