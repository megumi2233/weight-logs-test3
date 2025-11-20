@extends('layouts.common_pink')


@section('title', 'ログイン')
@section('content')
    <div class="login-wrapper">
        <h1 class="login-title">PiGLy</h1>
        <h2 class="login-heading">ログイン</h2>

        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" placeholder="メールアドレスを入力" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password" placeholder="パスワードを入力">
            </div>
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="login-button">ログイン</button>
        </form>

        <div class="register-link">
            <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
        </div>
    </div>
@endsection
