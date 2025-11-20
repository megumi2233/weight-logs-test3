@extends('layouts.common_white')

@section('title', '検索画面')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <!-- サマリー -->
        <div class="summary">
            <div class="summary-item">
                <span class="label">目標体重</span>
                <span class="value">45.0 kg</span>
            </div>
            <div class="summary-item">
                <span class="label">目標まで</span>
                <span class="value">-1.5 kg</span>
            </div>
            <div class="summary-item">
                <span class="label">最新体重</span>
                <span class="value">46.5 kg</span>
            </div>
        </div>

        <!-- 検索フォーム -->
        <div class="search-form">
            <form method="GET" action="{{ route('weight_logs.search') }}">
                <label>開始日:
                    <input type="date" name="from" value="{{ $from }}">
                </label>
                <label>終了日:
                    <input type="date" name="to" value="{{ $to }}">
                </label>

                <button type="submit" class="btn btn-search">検索</button>
                <button type="button" class="btn btn-reset" onclick="location.href='{{ route('weight_logs.index') }}'">
                    リセット
                </button>
                <a href="{{ route('weight_logs.create') }}" class="btn btn-add">データ追加</a>
            </form>

        </div>

        @if ($from && $to)
            <p class="search-result-info">
                {{ $from }} ～ {{ $to }} の検索結果　{{ $logs->total() }}件
            </p>
        @endif

        <!-- 検索結果テーブル -->
        <table class="weight-table">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>体重</th>
                    <th>食事摂取カロリー</th>
                    <th>運動時間</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->date }}</td>
                        <td>{{ $log->weight }}kg</td>
                        <td>{{ $log->calories }}cal</td>
                        <td>{{ $log->exercise_time }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">データがありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- ページネーション -->
        <div class="pagination">
            {{ $logs->links() }}
        </div>
    </div>
@endsection
