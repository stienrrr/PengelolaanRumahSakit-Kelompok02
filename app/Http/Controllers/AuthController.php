<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            $user = Auth::user();

            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $validated = $request->validate([
            'account' => 'required|string',
            'password' => 'required|string',
        ]);

        $fieldType = filter_var($validated['account'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $fieldType => $validated['account'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            return redirect()->route('dashboard');
        }

        Alert::error('Fail!', 'The account entered is incorrect!');
        return redirect()->back()->withInput();
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registration(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);

        if ($validation->fails()) {
            Alert::error('Fail', 'Registration has failed. Check your input data.');
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('pasien');

        // Login otomatis setelah daftar
        Alert::success('Success', 'Welcome, ' . $user->name . '!');
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout(); // Logout user

        return redirect()->route('login');
    }
}
