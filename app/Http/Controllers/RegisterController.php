<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterAccountRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterStep2Request;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('register.step1');
    }

    public function submitStep1(RegisterAccountRequest $request)
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user); 

        return redirect()->route('register.step2');
    }

    public function showStep2()
    {
        return view('register.step2');
    }

    public function submitStep2(RegisterStep2Request $request)
    {
        $validated = $request->validated();

        WeightTarget::create([
            'user_id' => Auth::id(),
            'current_weight' => $validated['current_weight'],
            'target_weight' => $validated['target_weight'],
        ]);

        return redirect()->route('weight_logs.index')->with('success', '初期体重を登録しました');
    }
}
