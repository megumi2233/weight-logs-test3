<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/weight_logs';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ログイン成功時に強制的に /weight_logs にリダイレクト
    protected function authenticated(Request $request, $user)
    {
        return redirect('/weight_logs')->with('success', 'ログインしました！');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => ['メールアドレスまたはパスワードが正しくありません。'],
        ]);
    }
}
