<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->level == 'admin') {
                return redirect()->route('question.index');
            }
            return redirect()->route('assessment.index');
        }
        return redirect('login');
    }
    
    public function login()
    {
        return view('pages.auth.login', ['user' => new User]);
    }

    public function store_login(Request $request)
    {
        $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->level == 'admin') {
                return redirect()->route('question.index');
            }
            return redirect()->route('assessment.index');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provide credentials does not match our records.'
        ]);
    }

    public function register()
    {
        return view('pages.auth.register', ['user' => new User]);
    }

    public function store_register(Request $request)
    {
        $input = $request->all();
        // dd($request->all());
        $request->validate([
            'fullname' => ['required', 'unique:users', 'string', 'alpha_num', 'min:3', 'max:25'],
            'email'    => ['required', 'email', 'unique:users'],
            'name'     => ['required', 'string', 'min:3'],
            'level'    => ['required'],
            'password' => ['required', 'min:8'],
        ]);

        $input['password'] = Hash::make($input['password']);
        
        $post = User::create($input);
        if ($post) {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                if ($user->level == 'admin') {
                    return redirect()->route('question.index');
                }
                return redirect()->route('assessment.index');
            }
            return back()->with('success', 'Thank you, you are now registered');
        } else {
            return back()->with('error', 'Some problems occur, please try again');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provide credentials does not match our records.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect(RouteServiceProvider::HOME);
    }
}
