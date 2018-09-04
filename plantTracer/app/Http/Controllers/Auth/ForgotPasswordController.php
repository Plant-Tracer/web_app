<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\User;
use DB;

class ForgotPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getResetView()
    {
        return view('forgotpassword');
    }

    public function resetAuthenticated(Request $request)
    {
        $this->validate($request, ['password' => 'required|confirmed|min:6']);

        $credentials = $request->only('password', 'password_confirmation');

        $email = $request->get('email');

        $user = User::where('email', $request->get('email'))->first();

        $user->update(['password' => $request->get('password')]);

        return redirect('index');

    }
}

