@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_goal_setting.css') }}">
@endsection

@section('content')
<div class="goal-setting__content">
    <h2>目標体重設定</h2>
    <form action="{{ route('weight_logs.goal_setting.update') }}" method="POST">
        @csrf
        <div class="form__group form__group--centered">
            <div class="input-with-unit input-with-unit--centered">
                <input type="text" name="target_weight" id="target_weight" placeholder="例: 60.0" value="{{ old('target_weight', $targetWeight) }}">
                <span class="unit-text">kg</span>
            </div>
            <div class="form__error">@error('target_weight')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__button-group">
            <a href="{{ route('weight_logs.index') }}" class="button back-button-goal">戻る</a>
            <button type="submit" class="button update-button-gradient">更新</button>
        </div>
    </form>
</div>
@endsection