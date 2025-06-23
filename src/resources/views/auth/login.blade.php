@extends('layouts.guest')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login-form__heading">
        <h1 class="logo">PiGLy</h1>
        <h2>ログイン</h2>
    </div>
    <form class="form" action="{{ route('login') }}" method="post" novalidate>
        @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="メールアドレスを入力" />
                </div>
                @error('email')
                    <div class="form__error">
                        @foreach ($errors->get('email') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">パスワード</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="password" name="password" placeholder="パスワードを入力" />
                </div>
                @error('password')
                    <div class="form__error">
                        @foreach ($errors->get('password') as $message)
                            <div>{{ $message }}</div>
                        @endforeach
                    </div>
                @enderror
            </div>
        </div>
        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
    <div class="register-link">
        <a href="{{ route('register.step1') }}">アカウント作成はこちら</a>
    </div>
</div>
@endsection