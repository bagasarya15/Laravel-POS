<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ User, Auth };
use Illuminate\Support\Facades\{ Validator, Storage };

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        return view('auth.profile', compact('user'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
        ];

        $eMessage = [
            'username.required' => 'Username tidak boleh kosong !',
            'username.unique'   => 'Username sudah digunakan !',
            'name.required'     => 'Nama tidak boleh kosong !',
            'email.required'    => 'Email tidak boleh kosong !',
            'email.unique'      => 'Email sudah digunakan !' 
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
