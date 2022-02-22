<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class UserAuthenticateController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());

        event(new Registered($user));

        Auth::login($user);

        return to_route('login')->with(feedback('Your account created successfully.', 'success'));
    }
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated(), $request->remember ? true : false)) {

            return back()->with(feedback('Invalid login credential details.', 'error'));
        }
        return to_route('image.index')->with(feedback('Welcome back! Login Success.', 'success'));
    }

    public function logout()
    {
        Auth::logout();
        return to_route('login')->with(feedback('Logout success.', 'success'));
    }
}
