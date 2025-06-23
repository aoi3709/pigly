<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use App\Http\Requests\WeightLogRequest;
use Carbon\Carbon;

class WeightLogController extends Controller
{
    /**
     * 体重ログの一覧を表示。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $weightTarget = $user->weightTarget;
        $latestWeightLog = $user->weightLogs()->latest('date')->first();
        $currentWeight = $latestWeightLog ? $latestWeightLog->weight : null;
        $targetWeight = $weightTarget ? $weightTarget->target_weight : null;
        $weightDifference = null;

        if ($currentWeight !== null && $targetWeight !== null) {
            $weightDifference = round($currentWeight - $targetWeight, 1);
        }

        $query = $user->weightLogs();
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        if ($dateFrom) {
            $query->where('date', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->where('date', '<=', $dateTo);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8);
        $searchResultsCount = $weightLogs->total();

        $hasAddLogErrors = $request->session()->get('errors') && $request->session()->get('errors')->any();

        return view('weight_logs.index', compact(
            'weightTarget',
            'latestWeightLog',
            'currentWeight',
            'targetWeight',
            'weightDifference',
            'weightLogs',
            'dateFrom',
            'dateTo',
            'searchResultsCount',
            'hasAddLogErrors'
        ));
    }

    /**
     * 体重ログをデータベースに保存。
     *
     * @param  \App\Http\Requests\WeightLogRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(WeightLogRequest $request)
    {
        $user = Auth::user();

        $user->weightLogs()->create([
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '体重ログを登録しました！');
    }

    /**
     * 体重ログの編集フォームを表示。
     *
     * @param  int  $weightLogId
     * @return \Illuminate\View\View
     */
    public function edit($weightLogId)
    {
        $weightLog = Auth::user()->weightLogs()->findOrFail($weightLogId);
        return view('weight_logs.edit', compact('weightLog'));
    }

    /**
     * 指定された体重ログを更新。
     *
     * @param  \App\Http\Requests\WeightLogRequest  $request 
     * @param  int  $weightLogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(WeightLogRequest $request, $weightLogId) 
    {
        $weightLog = Auth::user()->weightLogs()->findOrFail($weightLogId);

        $weightLog->update($request->validated());

        return redirect()->route('weight_logs.index')->with('success', '体重ログを更新しました。');
    }

    /**
     * 指定された体重ログを削除。
     *
     * @param  int  $weightLogId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($weightLogId)
    {
        $weightLog = Auth::user()->weightLogs()->findOrFail($weightLogId);
        $weightLog->delete();
        return redirect()->route('weight_logs.index')->with('success', '体重ログを削除しました。');
    }
}