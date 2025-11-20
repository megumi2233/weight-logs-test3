<div class="modal fade" id="weightLogModal" tabindex="-1" aria-labelledby="weightLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('weight_logs.store') }}" class="weight-form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="weightLogModalLabel">Weight Logを追加</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-body">
                    <!-- 日付 -->
                    <div class="mb-3">
                        <label for="date" class="form-label">日付 <span class="required">必須</span></label>
                        <input type="date" id="date" name="date" class="form-control"
                            value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}">
                        @error('date')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 体重 -->
                    <div class="mb-3 input-with-unit">
                        <label for="weight" class="form-label">体重 <span class="required">必須</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" id="weight" name="weight" class="form-control"
                                value="{{ old('weight') }}">
                            <span class="unit-label ms-2">kg</span>
                        </div>
                        @error('weight')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 摂取カロリー -->
                    <div class="mb-3 input-with-unit">
                        <label for="calories" class="form-label">摂取カロリー <span class="required">必須</span></label>
                        <div class="d-flex align-items-center">
                            <input type="text" id="calories" name="calories" class="form-control"
                                value="{{ old('calories') }}">
                            <span class="unit-label ms-2">cal</span>
                        </div>
                        @error('calories')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 運動時間 -->
                    <div class="mb-3">
                        <label for="exercise_time" class="form-label">運動時間 <span class="required">必須</span></label>
                        <input type="time" id="exercise_time" name="exercise_time" class="form-control"
                            value="{{ old('exercise_time') }}">
                        @error('exercise_time')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- 運動内容 -->
                    <div class="mb-3">
                        <label for="exercise_detail" class="form-label">運動内容</label>
                        <textarea id="exercise_detail" name="exercise_detail" class="form-control" rows="3">{{ old('exercise_detail') }}</textarea>
                        @error('exercise_detail')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light-gray" data-bs-dismiss="modal">戻る</button>
                    <button type="submit" class="btn btn-gradient">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>
