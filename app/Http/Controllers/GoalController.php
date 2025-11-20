<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGoalWeightRequest;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function index()
    {
        $goal = WeightTarget::where('user_id', Auth::id())->first();
        $currentGoal = $goal ? $goal->target_weight : null;

        return view('goal.goal_setting', compact('currentGoal'));
    }

    public function update(UpdateGoalWeightRequest $request)
    {
        WeightTarget::updateOrCreate(
            ['user_id' => Auth::id()],
            ['target_weight' => $request->goal_weight]
        );

        return redirect()->route('weight_logs.index');
    }
}
