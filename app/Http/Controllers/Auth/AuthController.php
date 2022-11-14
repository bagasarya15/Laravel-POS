<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{ User };
use Illuminate\Support\Facades\{ Auth, Validator, Storage, Hash };

class AuthController extends Controller
{
    public function redirectTo() 
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('dashboard');
            } else if (auth()->user()->role_id == 2) {
                return redirect()->route('user.index');
            } else if (auth()->user()->role_id == 3) {
                return redirect()->route('user.index');
            }
        }
        return redirect()->route('login');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request) 
    {
        $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
        ];

        $eMessage = [
            'username.required' => 'Isi username terlebih dahulu !',
            'password.required' => 'Isi password terlebih dahulu !'
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $credentials = $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
        ]);

        // if(Auth::attempt($credentials)) {

        // $request->session()->regenerate();
        
        // return redirect()->intended(route('dashboard'))
        //                     ->with('success', 'Selamat Datang, '.Auth::user()->name);
        // }

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            if( auth()->user()->role_id == 1) {
                return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
            }else if( auth()->user()->role_id == 2) {
                return redirect()->route('user.index')->with('success', 'Selamat datang, '.Auth::user()->name);
            }else if( auth()->user()->role_id == 3) {
                return redirect()->route('user.index')->with('success', 'Selamat datang, '.Auth::user()->name);
            } 
        }
        return redirect()->back()->with('error', 'Username atau Password Salah !');
    }

    public function update(Request $request, User $user )
    {
        $rules = [
            'current_password' => 'required',
            'password'         => 'required_with:confirm_password|same:confirm_password|min:5',
            'confirm_password' => 'min:5'
        ];

        $eMessage = [
            'current_password.required' => 'Isi password lama terlebih dahulu !',
            'password.required'         => 'Isi password baru anda !',
            'password.min:5'            => 'Password minimal 5 huruf atau angka !',
            'password.same'             => 'Konfirmasi password baru tidak sama, coba lagi !'
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails()){
            return redirect()->back()->with('warning', $validator->errors()->first());
        }
    
        if ( !Hash::check($request->current_password, auth()->user()->password))
        {
            return back()->with('error', 'Password lama yang anda masukkan salah, coba lagi !');
        }
        else if ( Hash::check($request->current_password, auth()->user()->password))
        {
            auth()->user()->update(['password' => Hash::make($request->password)]);
            return back()->with('success', 'Password berhasil diubah !');
        }        
    }

    public function logout() 
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar, sampai jumpa !');
    }
}
