@extends('layouts.guest')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register__content">
    <div class="register-form__heading">
        <h2>新規会員登録</h2>
        <h3>STEP2 体重データの入力</h3>
    </div>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form class="form" action="{{ route('register.processStep2') }}" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">現在の体重</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="current_weight" value="{{ old('current_weight') }}" placeholder="現在の体重を入力" /> kg
                </div>
                @error('current_weight')
                    <div class="form__error">
                        @foreach ($errors->get('current_weight') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">目標の体重</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="target_weight" value="{{ old('target_weight') }}" placeholder="目標の体重を入力" /> kg
                </div>
                @error('target_weight')
                    <div class="form__error">
                        @foreach ($errors->get('target_weight') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">アカウント作成</button>
        </div>
    </form>
</div>
@endsection