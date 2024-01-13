<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('users.register');
    }

    public function save(Request $request)
    {
        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        $formData['password'] = bcrypt($formData['password'], []);

        $user = User::create($formData);

        auth()->login($user);

        return redirect('/')
            ->with('success', 'User account created, you\'re logged in');
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out');
    }

    public function login(Request $request)
    {
        if ($request->isMethod("POST")) {
            $formData = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (auth()->attempt($formData)) {
                $request->session()->regenerate();

                return redirect('/')
                    ->with('success', 'You are logged in');
            }
            return back()
                ->withErrors(['email' => 'Invalid Credentials'])
                ->onlyInput('email');
        }
        return view('users.login');
    }
}
