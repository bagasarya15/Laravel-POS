<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\{ User, Settings };
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{ Auth, Validator, Storage, Hash};

class AuthController extends Controller
{
    public function redirectTo() 
    {
        if (auth()->check()) {
            if (auth()->user()->role_id == 1) {
                return redirect()->route('dashboard');
            } else if (auth()->user()->role_id == 2) {
                return redirect()->route('dashboard');
            } else if (auth()->user()->role_id == 3) {
                return redirect()->route('transaction.index');
            }
        }
        return redirect()->route('login');
    }

    public function index()
    {
        $store_information = Settings::find(1);
        return view('auth.login', compact('store_information'));
    }

    public function login(Request $request) 
    {
        $rules = [
        'emailOrUsername' => 'required|string',
        'password' => 'required|string',
        ];

        $eMessage = [
            'emailOrUsername.required' => 'Isi username atau email terlebih dahulu !',
            'password.required' => 'Isi password terlebih dahulu !'
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails())
        {
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        // Login With Username Or Email
        $login_type = filter_var($request->input('emailOrUsername'), FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

        $request->merge([
            $login_type => $request->input('emailOrUsername')
        ]);
        
        if (auth()->attempt( $request->only($login_type, 'password') ) )
        {
            $request->session()->regenerate();
            
            if( auth()->user()->role_id == 1)
            {
                auth()->user()->update(['is_login' => $request->is_login = 1 ]);
                return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
            }
            else if( auth()->user()->role_id == 2) 
            {
                auth()->user()->update(['is_login' => $request->is_login = 1 ]);
                return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
            }
            else if( auth()->user()->role_id == 3)
            {
                auth()->user()->update(['is_login' => $request->is_login = 1 ]);
                return redirect()->route('transaction.index')->with('success', 'Selamat datang, '.Auth::user()->name);
            } 
        } 
        else
        {
            return redirect()->back()->with('error', 'Login gagal, pastikan data yang dimasukkan sudah benar!');
        }
        // End Login With Username Or Email


        // [Code Jika Ingin Login Menggunakan Username Saja]

        // if ($validator->fails()){
        //     return redirect()->back()->with('warning', $validator->errors()->first());
        // }

        // [request name di input login.blade ganti dari emailOrUsername menjadi username]
        // $credentials = $request->validate([
        //     'username'   => 'required|string', 
        //     'password'   => 'required|string',
        // ]);

        // if (auth()->attempt($credentials)) {
        //     $request->session()->regenerate();
            
        //     if( auth()->user()->role_id == 1)
        //     {
        //         auth()->user()->update(['is_login' => $request->is_login = 1 ]);
        //         return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
        //     }
        //     else if( auth()->user()->role_id == 2) 
        //     {
        //         auth()->user()->update(['is_login' => $request->is_login = 1 ]);
        //         return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
        //     }
        //     else if( auth()->user()->role_id == 3)
        //     {
        //         auth()->user()->update(['is_login' => $request->is_login = 1 ]);
        //         return redirect()->route('transaction.index')->with('success', 'Selamat datang, '.Auth::user()->name);
        //     } 
        // }
        // return redirect()->back()->with('error', 'Username atau Password Salah !');

        // [End]
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

    public function logout(Request $request) 
    {
        //Request Before Logout
        auth()->user()->update(['is_login' => $request->is_login = 0 ]);
        auth()->user()->update(['last_login' => Carbon::now($request->last_login)]);
        //End
        
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil keluar, sampai jumpa');
    }
}
