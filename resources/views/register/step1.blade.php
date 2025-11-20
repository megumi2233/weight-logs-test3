@extends('layouts.common_pink')

@section('title', '新規会員登録')
@section('content')
    <div class="register-wrapper">
        <h1 class="title">PiGLy</h1>
        <h2 class="subtitle">新規会員登録</h2>
        <h3 class="subtitle">STEP1 アカウント情報の登録</h3>

        <form method="POST" action="{{ route('register.step1.submit') }}" class="register-form">
            @csrf

            <!-- お名前 -->
            <label for="name" class="form-label">お名前</label>
            <input type="text" id="name" name="name" class="form-input" placeholder="名前を入力" value="{{ old('name') }}">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- メールアドレス -->
            <label for="email" class="form-label">メールアドレス</label>
            <input type="email" id="email" name="email" class="form-input" placeholder="メールアドレスを入力" value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <!-- パスワード -->
            <label for="password" class="form-label">パスワード</label>
            <input type="password" id="password" name="password" class="form-input" placeholder="パスワードを入力">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit" class="submit-button">次に進む</button>
        </form>

        <div class="account-create-link">
            <a href="{{ route('login') }}">ログインはこちら</a>
        </div>
    </div>
@endsection
