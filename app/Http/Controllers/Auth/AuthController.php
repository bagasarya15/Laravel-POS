<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\{Str, Carbon};
use Illuminate\Support\Facades\Artisan;
use App\Models\{ User, Settings, Transaction, OrderMember };
use Illuminate\Support\Facades\{ Auth, Validator, Storage, Hash, Mail, DB };

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
    
    public function getRegister()
    {
        $store_information = Settings::find(1);
        return view('auth.register', compact('store_information'));
    }

    public function postRegister(Request $request){
        $rules = [
            'username'         => 'required|unique:users,username', 
            'name'             => 'required',
            'password'         => 'required_with:confirm_password|same:confirm_password|min:5',
            'confirm_password' => 'min:5',
        ];

        $eMessage = [
            'name.required'             => 'Isi nama terlebih dahulu',
            'username.required'         => 'Isi username terlebih dahulu',
            'username.unique'           => 'Username tidak tersedia, coba lagi',
            'password.required'         => 'Isi password terlebih dahulu',
            'password.min:5'            => 'Password minimal 5 huruf atau angka',
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

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
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
                //Request Update Last Login
                auth()->user()->update(['last_login' => Carbon::now($request->last_login)]);
                //End

                //If Login Reset Product in Cart and Customer
                $this->artisanClear();
                $this->nullCart();
                $this->nullCustomer();
                //End

                return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
            }
            else if( auth()->user()->role_id == 2) 
            {
                //Request Update Last Login
                auth()->user()->update(['last_login' => Carbon::now($request->last_login)]);
                //End

                //If Login Reset Product in Cart and Customer
                $this->artisanClear();
                $this->nullCart();
                $this->nullCustomer();
                //End

                return redirect()->route('dashboard')->with('success', 'Selamat datang, '.Auth::user()->name);
            }
            else if( auth()->user()->role_id == 3)
            {
                //Request Update Last Login
                auth()->user()->update(['last_login' => Carbon::now($request->last_login)]);
                //End

                //If Login Reset Product in Cart and Customer
                $this->artisanClear();
                $this->nullCart();
                $this->nullCustomer();
                //End

                return redirect()->route('transaction.index')->with('success', 'Selamat datang, '.Auth::user()->name);
            } 
        } 
        else
        {
            return redirect()->back()->with('error', 'Login gagal, pastikan username, email atau password yang dimasukkan sudah benar !');
        }
        // End Login With Username Or Email


        // [Code If u Want Login Only Use Username]

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
    
    //Function For Get ForgetPass
    public function getForgetPass()
    {
        $store_information = Settings::find(1);
        return view('auth.forget-pass', compact('store_information'));
    }

    public function postForgetPass(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        // ]);

        $rules = [
            'email' => 'required|email|exists:users',
        ];

        $eMessage = [
            'email.required' => 'Isi email terlebih dahulu',
            'email.exists'    => 'Email yang anda input tidak terdaftar',
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails())
        {
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $token = Str::random(60);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::send('auth.verify',['token' => $token], function($message) use ($request) {
                $message->from('livewirelaravel@gmail.com');
                $message->to($request->email);
                $message->subject('Atur Ulang Pemberitahuan Kata Sandi');
        });
        
        return back()->with('success', 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui email');
    }
    //End

    //Function For Post Reset Pass After Get Token From Email
    public function getResetPass($token)
    {
        $store_information = Settings::find(1);

        return view('auth.password-reset', compact('store_information', 'token'));
    }

    public function postResetPass(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users',
        //     'password' => 'required|string|min:6|confirmed',
        //     'password_confirmation' => 'required',
        // ]);
        
        $rules = [
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ];

        $eMessage = [
            'email.required'    => 'Isi email terlebih dahulu',
            'email.exists'      => 'Email yang anda input tidak terdaftar',
            'password.required' => 'Isi password terlebih dahulu',
            'password.min:5'    => 'Password minimal 5 huruf dan angka',
            'password.same'     => 'Password tidak sama coba lagi'
        ];

        $validator = Validator::make($request->all(), $rules, $eMessage);

        if ($validator->fails())
        {
            return redirect()->back()->with('warning', $validator->errors()->first());
        }

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])
                            ->first();

        if(!$updatePassword)
            return back()->withInput()->with('error', 'Token Invalid');

        $user = User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect()->route('login')->with('success', 'Kata sandi anda berhasil diubah');
    }
    //End

    //Function For Reset Cart & Customer
    public function nullCart()
    {
        $deleteTransaction = Transaction::where('add_by', '=', auth()->user()->id )->delete();
    }

    public function nullCustomer()
    {
        $deleteOrderMember = OrderMember::where('add_by', '=', auth()->user()->id )->delete();
    }
    //End Function Reset Cart & Customer

    public function artisanClear()
    {
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
    }
    
    public function logout(Request $request) 
    {
        //Request Before Logout
        auth()->user()->update(['last_login' => Carbon::now($request->last_login)]);
        //End

        //If Logout Delete Product in Cart and Customer
        $this->artisanClear();
        $this->nullCart();
        $this->nullCustomer();
        //End

        //Logout Auth
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        //End

        return redirect()->route('login')->with('success', 'Berhasil keluar, sampai jumpa');
    }
}
