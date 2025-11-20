@extends('layouts.common_white')

@section('title', '管理画面 - PiGLy')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard">
        <div class="summary">
            <p>目標体重：{{ $weightTarget->target_weight }} kg</p>
            <p>最新体重：{{ $latestWeight }} kg</p>
            <p>目標まで：{{ $latestWeight - $weightTarget->target_weight }} kg</p>
        </div>

        <form method="GET" action="{{ route('weight_logs.search') }}" class="search-form">
            <label for="from">開始日:</label>
            <input type="date" id="from" name="from">
            <label for="to">終了日:</label>
            <input type="date" id="to" name="to">
            <button type="submit" class="btn btn-search">検索</button>
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#weightLogModal">
                データ追加
            </button>
        </form>

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
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($log->date)->format('Y/m/d') }}</td>
                        <td>{{ $log->weight }}kg</td>
                        <td>{{ number_format($log->calories, 0) }}cal</td>
                        <td>{{ \Carbon\Carbon::parse($log->exercise_time)->format('H:i') }}</td>
                        <td>
                            <a href="{{ route('weight_logs.show', $log->id) }}" class="edit-icon">
                                <i class="fas fa-pencil-alt" style="color: red;"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">データがありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $logs->links() }}
        </div>
        @include('weight_logs.modal_create')
    </div>
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Bootstrapのモーダルを取得して表示
                const modal = new bootstrap.Modal(document.getElementById('weightLogModal'));
                modal.show();
            });
        </script>
    @endif
@endsection
