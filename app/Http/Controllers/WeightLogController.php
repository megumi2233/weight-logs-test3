<?php

namespace App\Http\Controllers;

use App\Models\WeightLog;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateWeightLogRequest;
use App\Models\WeightTarget;
use App\Http\Requests\StoreWeightLogRequest;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        $weightTarget = WeightTarget::where('user_id', $user->id)->first();

        $logs = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->paginate(8);

        $latestLog = $logs->first();
        $latestWeight = $latestLog ? $latestLog->weight : ($weightTarget->current_weight ?? null);

        $diff = ($latestWeight && $weightTarget) ? $latestWeight - $weightTarget->target_weight : null;

        return view('weight_logs.index', compact('logs', 'weightTarget', 'latestWeight', 'diff'));
    }



    public function search(Request $request)
    {
        $from = $request->input('from');
        $to   = $request->input('to');
        $logs = WeightLog::query()
            ->when($from, fn($q) => $q->whereDate('date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('date', '<=', $to))
            ->paginate(8);

        return view('weight_logs.search', compact('logs', 'from', 'to'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    public function store(StoreWeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => auth()->id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_detail' => $request->exercise_detail,
        ]);

        return redirect()->route('weight_logs.index')
            ->with('success', '体重ログを登録しました');
    }

    public function show(WeightLog $weightLog)
    {
        return view('weight_logs.show', compact('weightLog'));
    }

    public function destroy(WeightLog $weightLog)
    {
        $weightLog->delete();
        return redirect()->route('weight_logs.index');
    }

    public function update(UpdateWeightLogRequest $request, WeightLog $weightLog)
    {
        // 所有チェック（念のため）
        if ($weightLog->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validated();

        // フォームと Request でフィールド名が異なる場合の互換処理
        if (isset($validated['exercise_content']) && !isset($validated['exercise_detail'])) {
            $validated['exercise_detail'] = $validated['exercise_content'];
            unset($validated['exercise_content']);
        }

        $weightLog->update($validated);

        return redirect()->route('weight_logs.show', $weightLog->id)
            ->with('success', '体重ログを更新しました');
    }
}
