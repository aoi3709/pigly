<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;

class RegisterController extends Controller
{
    /**
     * 会員登録画面 (STEP1: アカウント情報の登録) を表示。
     *
     * @return \Illuminate\View\View
     */
    public function showStep1Form()
    {
        return view('auth.register_step1');
    }

    /**
     * 会員登録画面 (STEP1: アカウント情報の登録) のフォームを処理。
     * 入力されたアカウント情報を一時的にセッションに保存し、STEP2へリダイレクト。
     *
     * @param  \App\Http\Requests\RegisterStep1Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processStep1(RegisterStep1Request $request)
    {
        Session::put('registration_data', [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('register.step2');
    }

    /**
     * 初期体重登録画面 (STEP2: 体重データの入力) を表示する。
     * STEP1のデータがセッションにあるか確認する。
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showStep2Form()
    {
        if (!Session::has('registration_data')) {
            return redirect()->route('register.step1')->with('error', 'まずアカウント情報を入力してください。');
        }

        return view('auth.register_step2');
    }

    /**
     * 初期体重登録画面 (STEP2: 体重データの入力) のフォームを処理する。
     * STEP1のデータと合わせてユーザーを登録し、初期体重・目標体重も登録する。
     *
     * @param  \App\Http\Requests\RegisterStep2Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processStep2(RegisterStep2Request $request)
    {
        $registrationData = Session::get('registration_data');

        if (!$registrationData) {
            return redirect()->route('register.step1')->with('error', 'アカウント情報が失われました。再度入力してください。');
        }

        // ユーザー登録
        $user = User::create([
            'name' => $registrationData['name'],
            'email' => $registrationData['email'],
            'password' => $registrationData['password'], 
        ]);

        // 初期体重ログの登録
        $user->weightLogs()->create([
            'date' => now()->toDateString(), 
            'weight' => $request->current_weight,
            'calories' => 0, 
            'exercise_time' => '00:00:00', 
            'exercise_content' => '初期登録時の体重',
        ]);

        // 目標体重の登録
        $user->weightTarget()->create([
            'target_weight' => $request->target_weight,
        ]);

        // セッションデータをクリア
        Session::forget('registration_data');

        // アカウント作成後、自動的にログインさせる
        Auth::login($user);

        // ログイン後は体重管理画面へリダイレクト
        return redirect()->route('weight_logs.index')->with('success', 'アカウント作成が完了しました！');
    }
}