@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_create.css') }}">
@endsection

@section('content')
<div class="weight-logs-create__content">
    <h2>体重登録</h2>
    <form action="/weight_logs" method="POST" class="form">
        @csrf
        <div class="form__group">
            <label for="date">日付</label>
            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}">
            @error('date')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__group">
            <label for="weight">体重 (kg)</label>
            <input type="text" step="0.1" name="weight" id="weight" value="{{ old('weight') }}" placeholder="例: 65.5">
            @error('weight')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__group">
            <label for="calories">摂取カロリー (cal)</label>
            <input type="text" name="calories" id="calories" value="{{ old('calories') }}" placeholder="例: 1800">
            @error('calories')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__group">
            <label for="exercise_time">運動時間 (HH:MM)</label>
            <input type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', '00:00') }}">
            @error('exercise_time')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__group">
            <label for="exercise_content">運動内容</label>
            <textarea name="exercise_content" id="exercise_content" rows="5" placeholder="例: ジョギング30分、筋トレ（腕立て、腹筋）">{{ old('exercise_content') }}</textarea>
            @error('exercise_content')
            <div class="form__error">{{ $message }}</div>
            @enderror
        </div>
        <div class="form__button">
            <button type="submit">登録</button>
        </div>
    </form>
</div>
@endsection