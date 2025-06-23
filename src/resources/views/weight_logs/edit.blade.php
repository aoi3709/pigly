@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/weight_logs_edit.css') }}">
@endsection

@section('content')
<div class="weight-logs-edit__content">
    <h2 class="edit-title">Weight Log</h2>
    <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="POST">
        @csrf
        <div class="form__group">
            <label for="date">日付:</label>
            <input type="date" name="date" id="date" value="{{ old('date', $weightLog->date) }}">
            <div class="form__error">@error('date')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__group">
            <label for="weight">体重:</label>
            <div class="input-with-unit">
                <input type="text" name="weight" id="weight" placeholder="例: 65.5" value="{{ old('weight', $weightLog->weight) }}"> <span class="unit-text">kg</span>
            </div>
            <div class="form__error">@error('weight')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__group">
            <label for="calories">摂取カロリー:</label>
            <div class="input-with-unit">
                <input type="text" name="calories" id="calories" placeholder="例: 2000" value="{{ old('calories', $weightLog->calories) }}"> <span class="unit-text">cal</span>
            </div>
            <div class="form__error">@error('calories')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__group">
            <label for="exercise_time">運動時間:</label>
            <input type="time" name="exercise_time" id="exercise_time" value="{{ old('exercise_time', \Carbon\Carbon::parse($weightLog->exercise_time)->format('H:i')) }}">
            <div class="form__error">@error('exercise_time')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__group">
            <label for="exercise_content">運動内容:</label>
            <textarea name="exercise_content" id="exercise_content" rows="5" placeholder="今日の運動内容や特記事項">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
            <div class="form__error">@error('exercise_content')<div>{{ $message }}</div>@enderror</div>
        </div>
        <div class="form__actions">
            <div class="form__button-group">
                <a href="{{ route('weight_logs.index') }}" class="button back-button-edit">戻る</a>
                <button type="submit" class="button update-button-gradient">更新</button>
            </div>
        </div>
    </form>
    <form action="{{ route('weight_logs.destroy', $weightLog->id) }}" method="POST" class="delete-form-edit-page">
        @csrf
        @method('delete') 
        <button type="submit" class="button delete-button-icon" onclick="return confirm('本当にこのログを削除しますか？')">
            🗑️ 
        </button>
    </form>
</div>
@endsection