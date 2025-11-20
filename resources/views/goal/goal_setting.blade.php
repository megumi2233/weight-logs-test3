@extends('layouts.common_white')

@section('title', '目標体重設定')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/goal_setting.css') }}">
@endpush

@section('content')
    <div class="goal-setting">
        <h2 class="dashboard-title">目標体重設定</h2>

        <form method="POST" action="{{ route('goal.update') }}" class="goal-form">
            @csrf

            <div class="input-with-unit">
                <input type="text" step="0.1" id="goal_weight" name="goal_weight"
                    value="{{ old('goal_weight', $currentGoal) }}">
                <span class="unit-label">kg</span>
            </div>

            @error('goal_weight')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="form-actions">
                <a href="{{ route('weight_logs.index') }}" class="btn btn-secondary">戻る</a>
                <button type="submit" class="btn btn-primary">更新</button>
            </div>
        </form>
    </div>
@endsection
