<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:users',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => [
            'required',
            'string',
            'min:6',
            'regex:/^(?=.*[A-Za-z]).{6,}$/',
            'confirmed'
        ],
        'accept_rules' => 'accepted',
    ], [
        'name.required' => 'Введите имя.',
        'name.unique' => 'Пользователь с таким именем уже существует.',

        'email.required' => 'Введите адрес электронной почты.',
        'email.email' => 'Пожалуйста, введите корректный email.',
        'email.unique' => 'Такой email уже зарегистрирован.',

        'password.required' => 'Введите пароль.',
        'password.min' => 'Пароль должен содержать минимум 6 символов.',
        'password.regex' => 'Пароль должен содержать хотя бы одну латинскую букву (A–Z, a–z).',
        'password.confirmed' => 'Пароли не совпадают.',

        'accept_rules.accepted' => 'Необходимо согласие с правилами сайта.',
    ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => false,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Регистрация выполнена успешно!');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return Auth::user()->is_admin
                ? redirect()->route('admin.dashboard')->with('success', 'Добро пожаловать, администратор!')
                : redirect()->route('home')->with('success', 'Добро пожаловать!');
        }

        return back()->withErrors([
            'name' => 'Неверный логин или пароль.',
        ])->onlyInput('name');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Вы вышли из аккаунта.');
    }
}
