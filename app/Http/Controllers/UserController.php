<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $incominginfo = $request->validate(
            [
                'loginname' => 'required',
                'loginpassword' => 'required',
            ]
            );

            if (auth()->attempt(['name' => $incominginfo['loginname'], 'password' => $incominginfo['loginpassword']])) {
                $request->session()->regenerate();
            }
    
            return redirect('/');
    }
    public function logout() {
        auth()->logout();
        return redirect('/');
    }
    public function register(Request $request) {
        $icnomingIformation = $request->validate(
            [
                'name'=> ['required', Rule::unique('users', 'name')],
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'password' => 'required',

            ]
            );
        $icnomingIformation['password'] = bcrypt($icnomingIformation['password']);
        $user = User::create($icnomingIformation);
        auth()->login($user);
        return redirect('/');
    }
}
