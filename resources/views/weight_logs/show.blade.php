@extends('layouts.common_white')

@section('title', '体重詳細 - PiGLy')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endpush

@section('content')
    <div class="weight-log-detail">
        <h2>Weight Log</h2>

        <form method="POST" action="{{ route('weight_logs.update', $weightLog->id) }}">
            @csrf
            @method('POST')

            {{-- 入力フィールドたち --}}
            <div class="form-group">
                <label for="date">日付</label>
                <input type="date" id="date" name="date"
                    value="{{ old('date', \Carbon\Carbon::parse($weightLog->date)->format('Y-m-d')) }}" class="date-input">
                @error('date')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="weight">体重</label>
                <input type="text" id="weight" name="weight" value="{{ old('weight', $weightLog->weight) }}">
                @error('weight')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="calories">摂取カロリー</label>
                <input type="text" id="calories" name="calories" value="{{ old('calories', $weightLog->calories) }}">
                @error('calories')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exercise_time">運動時間</label>
                <input type="time" id="exercise_time" name="exercise_time"
                    value="{{ old('exercise_time', $weightLog->exercise_time) }}">
                @error('exercise_time')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="exercise_content">運動内容</label>
                <textarea id="exercise_content" name="exercise_content" rows="3">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
                @error('exercise_content')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            {{-- ボタンたち --}}
            <div class="form-actions">
                <a href="{{ route('weight_logs.index') }}" class="btn btn-back">戻る</a>
                <button type="submit" class="btn btn-update">更新</button>
            </div>
        </form>

        {{-- 削除ボタンだけ別フォームでOK --}}
        <form method="POST" action="{{ route('weight_logs.destroy', $weightLog->id) }}" class="inline-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-delete">
                <img src="{{ asset('storage/img/trash-icon-red.png') }}" alt="削除" class="trash-icon">
            </button>
        </form>
    </div>
@endsection
