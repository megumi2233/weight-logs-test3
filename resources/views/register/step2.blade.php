@extends('layouts.common_pink')

@section('title', '初期体重登録')
@section('content')
    <div class="register-wrapper">
        <h1 class="logo">PiGLy</h1>
        <h2 class="register-heading">新規会員登録</h2>
        <h3 class="step-title">STEP2 体重データの入力</h3>

        <form method="POST" action="{{ route('register.step2.submit') }}" class="weight-form">
            @csrf

            <div class="form-group">
                <label for="current_weight">現在の体重</label>
                <div class="input-with-unit">
                    <input type="text" id="current_weight" name="current_weight" placeholder="現在の体重を入力"
                        value="{{ old('current_weight') }}">
                    <span class="unit">kg</span>
                </div>
                @error('current_weight')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="target_weight">目標の体重</label>
                <div class="input-with-unit">
                    <input type="text" id="target_weight" name="target_weight" placeholder="目標の体重を入力"
                        value="{{ old('target_weight') }}">
                    <span class="unit">kg</span>
                </div>
                @error('target_weight')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="submit-button">アカウント作成</button>
        </form>
    </div>
@endsection
