@extends('layouts.common_white')

@section('title', '体重登録')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/weight_create.css') }}">
@endpush

@section('content')
<div class="weight-create-container">
    <h2 class="form-title">Weight Logを追加</h2>

    <form method="POST" action="{{ route('weight_logs.store') }}" class="weight-form">
        @csrf

        <div class="form-group">
            <label for="date">日付 <span class="required">（必須）</span></label>
            <input type="date" id="date" name="date" value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
            @error('date')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group input-with-unit">
            <label for="weight">体重 <span class="required">（必須）</span></label>
            <input type="text" id="weight" name="weight" value="{{ old('weight') }}">
            <span class="unit-label">kg</span>
            @error('weight')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group input-with-unit">
            <label for="calories">摂取カロリー <span class="required">（必須）</span></label>
            <input type="text" id="calories" name="calories" value="{{ old('calories') }}">
            <span class="unit-label">cal</span>
            @error('calories')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_time">運動時間</label>
            <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time') }}">
            @error('exercise_time')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="exercise_detail">運動内容</label>
            <textarea id="exercise_detail" name="exercise_detail" rows="3">{{ old('exercise_detail') }}</textarea>
            @error('exercise_detail')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">登録</button>
        </div>
    </form>
</div>
@endsection
