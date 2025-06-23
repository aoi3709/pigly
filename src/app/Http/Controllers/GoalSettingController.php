<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightTarget;
use App\Http\Requests\UpdateGoalWeightRequest;

class GoalSettingController extends Controller
{
    /**
     * 目標体重設定画面を表示する。
     * ユーザーの現在の目標体重を取得してビューに渡す。
     *
     * @return \Illuminate\View\View
     */
    public function showGoalSetting()
    {
        $user = Auth::user();
        $weightTarget = $user->weightTarget;
        $targetWeightValue = $weightTarget ? $weightTarget->target_weight : null;

        return view('weight_logs.goal_setting', ['targetWeight' => $targetWeightValue]);
    }

    /**
     * 目標体重を更新する。
     *
     * @param  \App\Http\Requests\UpdateGoalWeightRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateGoalSetting(UpdateGoalWeightRequest $request)
    {

        $user = Auth::user();

        $newTargetWeight = $request->validated()['target_weight'];

        $user->weightTarget()->updateOrCreate(
            ['user_id' => $user->id], 
            ['target_weight' => $newTargetWeight] 
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }
}
