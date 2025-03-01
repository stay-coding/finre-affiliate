<?php

namespace App\Http\Controllers;

use App\Models\TotalComission;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function register()
    {
        return view('pages.auth.register');
    }

    public function afiliator_register(Request $request)
    {
        $message = [
            'name.required' => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Panjang password minimal 6 karakter'
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ], $message);

        $user = User::create([
            'name' => Str::apa($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('afiliator');

        UserInformation::create([
            'user_id' => $user->id,
        ]);

        TotalComission::create([
            'user_id' => $user->id,
        ]);

        flash()->addSuccess('Registrasi berhasil');

        return redirect('/login');
    }

    public function update_profile(Request $request)
    {
        $message = [
            'name.required' => 'Kolom nama harus diisi',
            'email.required' => 'Kolom email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Panjang password minimal 6 karakter',
            'phone.required' => 'Kolom No. Handphone harus diisi',
            'phone.min' => 'Panjang No. Handphone minimal 12 karakter',
            'phone.unique' => 'No. Handphone sudah terdaftar',
            'address.required' => 'Alamat wajid diisi',
            'bank_account.numeric' => 'Nomor rekening berupa angka',
            'e_wallet.numeric' => 'E-Wallet berupa angka',
        ];

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|min:12|unique:user_information,phone,' . $request->user_info_id,
            'bank_account' => 'nullable|numeric',
            'e_wallet' => 'nullable|numeric',
        ], $message);

        // Cari user berdasarkan id
        $user = User::find(Auth::user()->id);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $user->update([
            'name' => Str::apa($request->name),
            'email' => $request->email,
        ]);

        if ($request->phone) {
            UserInformation::where('user_id', $user->id)->update([
                'phone' => $request->phone,
            ]);
        }

        if ($request->address) {
            UserInformation::where('user_id', $user->id)->update([
                'address' => $request->address,
            ]);
        }

        if ($request->bank_name) {
            UserInformation::where('user_id', $user->id)->update([
                'bank_name' => Str::upper($request->bank_name),
            ]);
        }

        if ($request->bank_account) {
            UserInformation::where('user_id', $user->id)->update([
                'bank_account' => $request->bank_account
            ]);
        }

        if ($request->e_wallet) {
            UserInformation::where('user_id', $user->id)->update([
                'e_wallet' => $request->e_wallet
            ]);
        }

        sweetalert()->timer(2000)->addSuccess('Profil berhasil diperbarui');

        return redirect('/login');
    }

    public function login_process(Request $request)
    {
        $message = [
            'required' => 'Kolom :attribute harus diisi',
            'email' => 'Kolom :attribute harus berupa email',
            'min' => 'Kolom :attribute minimal :min karakter',
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], $message);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->hasRole('afiliator')) {
                flash()->options([
                    'position' => 'top-center',
                ])->addSuccess('Selamat datang ' . Auth::user()->name);

                return redirect('/dashboard/afiliator');
            } else {
                flash()->options([
                    'position' => 'top-center',
                ])->addSuccess('Selamat datang ' . Auth::user()->name);

                return redirect('/dashboard/admin');
            }
        }

        flash()->addError('Email atau password salah');

        return redirect()->back()->with('failed', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
